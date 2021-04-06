<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestBlog extends Model
{
    protected $table = 'test_blogs';
    public $timestamps= true;

    protected $fillable=['title','image','description'];
}
