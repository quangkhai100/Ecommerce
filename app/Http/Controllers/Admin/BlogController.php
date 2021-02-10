<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $blog = blog::all()->toArray();
        return view("admin.user.blog.index",compact('blog'));}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        blog::all();
        $blog = new blog();
        $blog->title = $request->titleBlog;
        $file1 = $request->image;
        //check avatar
        if(!empty($file1)){
            $file1->move('avatar/img',$file1->getClientOriginalName());
            $blog->image=$file1->getClientOriginalName();
        }
        $blog->description = $request->descriptionBlog;
        $blog->content=$request->ContentBlog;
        $blog->save();
        // DB::table('countries')->insert(['name'=>$request->countryName]);
        return redirect()->back()->withErrors('Add Successfully,'); 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.user.blog.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = blog::find($id);
        $blog->title=$request->titleBlog;
        $file = $request->image;
         //check avatar
         if(!empty($file)){
            $file->move('avatar/img',$file->getClientOriginalName());
            $blog->image=$file->getClientOriginalName();
        }
        $blog->description = $request->descriptionBlog;
        $blog->content=$request->ContentBlog;
        $blog->save();
        return view('admin/user/update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        blog::where('id',$request->blogDelete)->delete();
        $blog = blog::all()->toArray();
        return view("admin/user/blog",compact('blog'));

    }
}
