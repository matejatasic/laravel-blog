<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'img_path',
        'updated_at',
        'created_at',
    ];
    
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function comments() {
        return $this->hasMany(Comment::class);
    }
    
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }
}
