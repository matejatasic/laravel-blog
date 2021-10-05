<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Post;
use App\Models\Like;

class Comment extends Model
{
    use HasFactory;

    public function likedBy(User $user) {
        return $this->likes->contains('user_id', $user->id);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function post() {
        return $this->belongsTo(Post::class);
    }
    
    public function likes() {
        return $this->hasMany(Like::class);
    }
}
