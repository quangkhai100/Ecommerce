<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';
    public $timestamps= true;

    protected $fillable=['title','image','description','content'];
    public function comment() {
        return $this->hasMany('App\CommentBlog', 'blog_id');
    }

}
