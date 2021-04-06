<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Brand;
use App\Models\Category;

class HomeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        echo "<pre>";
        var_dump(session()->get('produc'));
        echo "</pre>";
        $category = category::all()->toArray();
        $brand = brand::all()->toArray();

        $products=products::orderBy('created_at','desc')->limit(6)->get();
        return view('frontend/pages/home',compact('products','category','brand'));
    }

    public function search(Request $request){
        $products=products::Where('name','like','%'.$request->search.'%')->orWhere('price',$request->search)->get();
        return view('frontend/pages/search',compact('products'));
    }

    public function searchAdvanced(Request $request){
    
        $product= products::query();
        if ($request->has('name')) {
            echo $request->name;
            $product->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('price')) {     
            if($request->price!='all'){
                if($request->price=='1-80'){
            $product->whereIn('price',range(1,50));
            }}
                        
        }

        if ($request->has('category')) {
            echo $request->category;
            if($request->category!='all'){
            $product->where('category', $request->category);
            }
        }
        
        if ($request->has('brand')) {
            echo $request->brand;
            if($request->brand!='all'){
            $product->where('brand', $request->brand);
            }
        }

        if ($request->has('status')) {
            if($request->status!='0'){
                echo $request->status;
            $product->where('sale', $request->status);
            }
        }
        $products =  $product->get();

        return view('frontend/pages/search', compact('products'));
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
