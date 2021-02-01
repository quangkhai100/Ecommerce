<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Blog;
use App\RateBlog;
use App\CommentBlog;
use App\User;
use Illuminate\Support\Facades\DB;
class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $blog = blog::paginate(3);
        return view('frontend/pages/bloglist',compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $total=0;
        $n=0;
       
        // tính trung bình cộng
        $getRateTbc=RateBlog::where('blog_id',$id)->get()->toArray();
        foreach ($getRateTbc as  $value) {           
            $total+=$value['rate'];
            $n+=1;
        }
        $userId= Auth::id();
        $tbc=round($total/$n);
        $commentBLog= CommentBlog::all()->toArray();
        $blog = Blog::with(['comment' => function ($q) {
            $q->orderBy('id', 'desc');
          }])->find($id)->toArray();

          $commentUser=CommentBlog::with('commentUser')->where('blog_id',$id)->get()->toArray();

        //   $user= DB::table('users')->join('comment_blog','users.id','=','comment_blog.user_id')->get();
        //   dd($commentUser);
        if (Auth::check()){
            return view('frontend/pages/blogSingle',compact('blog','userId','tbc','commentBLog','commentUser'));
        }
        else{
            return view('frontend/pages/blogSingle',compact('blog','tbc','commentBLog','commentUser'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
