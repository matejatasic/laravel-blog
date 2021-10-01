<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
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
            return redirect()->route('posts.index');
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

            $image_name = time() . 'user_image.' . $request->img_path->extension();
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
        
        $request->image->move(public_path('img/user_images'), $image_name);

        return redirect()->route('posts.index');
    }

    public function postLogout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}