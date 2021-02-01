<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentBlog extends Model
{
    protected $table = 'comment_blog';
    public $timestamps= true;

    public function commentUser(){
        return $this->belongsTo('App\User','user_id');
    }
}
