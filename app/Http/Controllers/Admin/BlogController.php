<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Requests\BlogRequest;
use App\Repositories\Admin\Blog\BlogInterface;

class BlogController extends Controller
{
    protected $blogInterface;
    public function __construct(BlogInterface $blogInterface)
    {
        $this->blogInterface = $blogInterface;
    }

    public function index()
    {
        $blog = $this->blogInterface->paginate(config('pagesnumber.pages_number'));
        return view("admin.user.blog.index",compact('blog'));
    }


    public function create()
    {
        return view('admin.user.blog.create');
    }

    public function store(BlogRequest $request)
    {
        $data= $request->all();
        
        if( $this->blogInterface->createBlog($data)){

            return redirect()->back()->with('successed', 'created success');
        }

        return redirect()->back()->with('failed', 'created fail');    

    }

    public function edit(Blog $blog)
    {
        return view('admin.user.blog.edit',compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog)
    {
        $data= $request->all();
        
        if( $this->blogInterface->updateBlog($data, $blog->id)){

            return redirect()->back()->with('successed', 'update success');
        }

        return redirect()->back()->with('failed', 'update fail');    

    }

    public function destroy(Blog $blog)
    {
        if ($this->blogInterface->delete($blog->id)){

            return redirect(route('blog.index'));
        }

        return redirect()->back()->withErrors('Delete Failed');
    }
}
