<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TestBlog;
use App\Http\Resources\Blog\BlogCollection as BlogCollection;
class BlogController extends Controller
{

    public function index()
    {
        return new BlogCollection (TestBlog::all());
    }


    public function store(Request $request)
    {
        return TestBlog::create($request->all());
    }

 
    public function show(TestBlog $blog)
    {
        return $blog;
    }

 
    public function update(Request $request, TestBlog $blog)
    {
        $blog->update($request->all());
    }


    public function destroy(TestBlog $blog)
    {
        $blog->delete();
    }
}
