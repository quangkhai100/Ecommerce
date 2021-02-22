<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Repositories\Admin\Category\CategoryInterface;

class CategoryController extends Controller
{
    protected $categoryInterface;

    public function __construct(CategoryInterface $categoryInterface)
    {
        $this->categoryInterface = $categoryInterface;
    }

    public function index()
    {
        $category = $this->categoryInterface->paginate(config('pagesnumber.pages_number'));
        return view("admin.user.category.index", compact('category'));
    }

    public function create()
    {
        return view('admin.user.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('name');
        if ($this->categoryInterface->create($data)) {

            return redirect()->back()->with('successed', 'created success');
        }
        return redirect()->back()->with('failed', 'created fail');    
    }

    public function edit(Category $category)
    {
        return view('admin.user.category.edit',compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->only('name');

        if ($this->categoryInterface->update($data, $category->id)) {

            return redirect()->back()->with('success', 'Update Succeed');
        }

        return redirect()->back()->withErrors('Update Failed');
    }

    public function destroy(Category $category)
    {
        if ($this->categoryInterface->delete($category->id)){

            return redirect(route('category.index'));
        }

        return redirect()->back()->withErrors('Delete Failed');
    }
}
