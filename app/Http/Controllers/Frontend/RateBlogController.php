<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RateBlog;
use Illuminate\Support\Facades\Auth;

class RateBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rate=$_POST['rate'];
        $idUser= Auth::id();
        $idBlog=$_POST['idBlog'];
        $user=array();
        $blog=array();
        $RateAll = RateBlog::all()->toArray();
        
        foreach ($RateAll as  $value) {
            array_push($user,$value['user_id']);
            array_push($blog,$value['blog_id']);
        }
        if (in_array($idUser,$user) && in_array($idBlog,$blog)){
            RateBlog::where('user_id',$idUser)->where('blog_id',$idBlog)->update(['rate'=>$rate]);
        }
        else{
            $RateBlog= New RateBlog();
            $RateBlog->rate=$rate;
            $RateBlog->user_id=$idUser;
            $RateBlog->blog_id=$idBlog;
            $RateBlog->save();
        }
        
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
        //
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
