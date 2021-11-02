<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Session;

class AuthController extends Controller
{
    public function getLogin() {
        return view('auth.login');
    }
    
    public function getRegister() {
        return view('auth.register');
    }

    public function postLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if(Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->first();

            Session::flash('success', 'You have successfully logged in!');

            if($user->isAdmin()) {
                return redirect()->route('admin.dashboard');   
            }
            else if($user->isUser()) {
                return redirect()->route('posts.index');
            }
        }
    }

    public function postRegister(Request $request) {
        $image_name;
        if($request->hasFile('img_path') && $request->file('img_path')->isValid()) {
            $this->validate($request, [
                'name' => 'required|',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'img_path' => 'mimes:jpeg,png|max:1024',
            ]);

            $image_name = '/img/user_images/' . time() . 'user_image.' . $request->img_path->extension();

            $request->img_path->move(public_path('img/user_images'), $image_name);
        }
        else {
            $this->validate($request, [
                'name' => 'required|',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
            ]);

            $image_name = '/img/user_images/default_image.jpg';
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->img_path = $image_name;
        $user->save();

        Session::flash('success', 'You have successfully registered!');

        return redirect()->route('getLogin');
    }

    public function postLogout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function forgotPassword() {
        return view('auth.forgot-password');
    }

    public function sendEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        $emailErrors = [];
        $user = User::where('email', $request->email)->first();
        
        if(!$user->exists()) {
            $emailErrors['no_user'] = 'There are no accounts associated with this email address';            
            return redirect()->route('forgotPassword')->withErrors($emailErrors);
        }

        $token = Str::random(60);
        $user->token = $token;
        $user->save();

        Mail::to($request->email)->send(new PasswordResetMail($user->name, $token));
        
        if(count(Mail::failures()) > 0) {
            $emailErrors['not_sent'] = 'Failed to send the email!';
            return redirect()->route('forgotPassword')->withErrors($emailErrors);   
        }

        Session::flash('success', 'An email has been sent, please check your inbox!');
        return redirect()->route('forgotPassword');
    }

    public function changePassword($token) {
        $user = User::where('token', $token)->first();
        if (!$user->exists()) {
            $error['expired_token'] = 'Your token has expired!';
            return redirect()->route('forgotPassword')->withErrors($error);
        }
        
        return view('auth.change-password', [
            'email' => $user->email,
        ]);
    }

    public function updatePassword(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user->exists()) {
            $error['invalid_email'] = 'The email is not valid!!';
            return redirect()->route('forgotPassword')->withErrors($error);    
        }

        $user->token = '';
        $user->password = Hash::make($request->password);
        $user->save();

        Session::flash('success', 'You have successfully changed your password!');
        return redirect()->route('getLogin');
    }
}
