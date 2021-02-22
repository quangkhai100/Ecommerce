<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $table = 'blog';
    public $timestamps= true;

    protected $fillable=['title','image','description','content'];
    public function comment() {
        return $this->hasMany('App\CommentBlog', 'blog_id');
    }

    public function getImageURLattribute()
    {
        return isset($this->image) ? asset('storage/' . $this->image) : null;
    }
    // public function getImageattribute($value)
    // {
    //     return isset($value) ? asset('storage/' . $value) : null;
    // }
}
