<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Repositories\Admin\Brand\BrandInterface;

class BrandController extends Controller
{
    protected $brandInterface;
    
    public function __construct(BrandInterface $brandInterface)
    {
        $this->brandInterface = $brandInterface;
    }

    public function index()
    {
        $brand = $this->brandInterface->paginate(config('pagesnumber.pages_number'));

        return view('admin.user.brand.index',compact('brand'));
    }

    public function create()
    {
        return view('admin.user.brand.create');
    }

    public function store(Request $request)
    {        
        $data = $request->only('name');
        if ($this->brandInterface->create($data)) {

            return redirect()->back()->with('successed', 'created success');
        }
        return redirect()->back()->with('failed', 'created fail');   
    }

    public function edit(Brand $brand)
    {
        return view('admin.user.brand.edit',compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->only('name');

        if ($this->brandInterface->update($data, $brand->id)) {

            return redirect()->back()->with('success', 'Update Succeed');
        }

        return redirect()->back()->withErrors('Update Failed');
    }

    public function destroy(Brand $brand)
    {
        if ($this->brandInterface->delete($brand->id)){

            return redirect(route('brand.index'));
        }

        return redirect()->back()->withErrors('Delete Failed');
    }
}
