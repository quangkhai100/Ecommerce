<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\Http\Requests\ProductRequest;
use App\Products;
use Intervention\Image\ImageManagerStatic as Image;
use Auth;
use Symfony\Component\HttpFoundation\Session\Session;
class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       

        $products = products::all();
        return view('frontend/pages/myProduct', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category::all()->toArray();
        $brand = brand::all()->toArray();


        return view('frontend/pages/addProduct', compact('category', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $userId = Auth::id();
        $products = new products();
        $data = $request->all;
        $products->name=$request->name;
        $products->price = $request->price;
        $products->category = $_POST['category'];
        $products->brand = $_POST['brand'];
        $products->sale = $_POST['sale'];
        $products->user_id = $userId;
        $products->company = $request->companyProfile;
        $products->descrip = $request->descrip;
        $products->user_id = $userId;

        if ($request->percenSale != '') {
            $products->amount_sale = $request->percenSale;
        }
        $file='multipleImage';
        if ($request->hasfile('multipleImage')) {
        $data= $this->uploadImageSize($request,$userId,$file);
        $products->images = json_encode($data);
        $products->save();    
        return back()->with('success', 'Your images has been successfully');
        }
    }

    //function uploade image
    public function uploadImageSize($request,$userId,$file){
        $data = array();
            foreach ($request->file($file) as $image) {
                if (!is_dir('upload/user/' . $userId . '/')) {
                    //Directory does not exist, so lets create it.
                    mkdir('upload/user/' . $userId . '/', 0755, true);
                }
                $name = $image->getClientOriginalName();
                $name_2 = "img50_" . strtotime(date('Y-m-d H:i:s')) . "_" . $image->getClientOriginalName();
                $name_3 = "img300_" . strtotime(date('Y-m-d H:i:s')) . "_" . $image->getClientOriginalName();
                //$image->move('upload/product/', $name);
                // - upload/user/product/1/
                // - tao path trc : kiem tra co path chua, co thi upload vao, chua co thi path ra.
                // - img50_, img300
                // - demp.png => ip, demp.png => ss , img50_43634636_name.png
                // - 

                $path = public_path('upload/user/' . $userId . '/' . $name);
                $path2 = public_path('upload/user/' . $userId . '/' . $name_2);
                $path3 = public_path('upload/user/' . $userId . '/' . $name_3);

                Image::make($image->getRealPath())->save($path);
                Image::make($image->getRealPath())->resize(50, 70)->save($path2);
                Image::make($image->getRealPath())->resize(200, 300)->save($path3);
                $data[] = $name;
            }
        return $data;
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
        $products = products::where('id', $id)->get()->toArray();
        foreach ($products as $value) {
            $productUpdated = $value;
        }
        $category = category::all()->toArray();
        $brand = brand::all()->toArray();

        return view('frontend/pages/editProduct', compact('category', 'brand', 'productUpdated'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $userId = Auth::id();
        $data = $request->all(); //lay all value
        $products = products::find($id);
        $products->name=$request->name;
        $products->price=$request->price;
        $products->category=$request->category;
        $products->brand=$request->brand;
        $products->sale=$request->sale;
        $products->amount_sale=$request->amount_sale;
        $products->company=$request->company;
        $products->descrip=$request->descrip;
        $products->save();

        // xoa images
        $product = products::where('id', $id)->get()->toArray();
        $array = array();

        foreach ($product as $value) {
            $array = json_decode($value['images'], TRUE);
        }
        if (isset($data['remove'])) {
            foreach ($array as $key => $value) {

                if (in_array($value, $data['remove'])) {
                    unset($array[$key]);
                }
            }
            $array=array_values($array);
            $products = products::find($id);
            $products->images = json_encode($array);
            $products->save();
            return redirect()->back();
        }
        //sua anh
        $file = $request->multipleImage;
        if ($request->hasfile('multipleImage')) {
            if (count($array)+ count($file) <= 3) {
                $file2='multipleImage';
                $data= $this->uploadImageSize($request,$userId,$file2);
                $arrayProduct=array_merge($array,$data);
                $arrayProduct=array_values($arrayProduct);
                $products = products::find($id);
                $products->images = json_encode($arrayProduct);
                $products->save();
                return redirect()->back();
            }
            else {
                return redirect()->back()->withErrors('Only 3 images are allowed');
            }
        }

        return redirect()->back();
    }

    public function productDetailsView($id){
        $products=products::where('id',$id)->get()->toArray();
        return view('frontend/pages/productDetails',compact('products'));
    }

    public function ajaxAddtoCart(){
        $getId = $_POST['idProduct'];
        $flag=true;

        $product=array(
            'id'=>$getId,
            'quality'=>1
        );
        
        if (session()->has('produc')){
           $a = session()->get('produc'); 
           foreach ($a as $key => $value) {
               if ($value['id']==$getId){    
                $a[$key]['quality'] +=1;
                session()->put('produc', $a);
                $flag=false;
               }
           }
        }   

        if ($flag){
            session()->push('produc',$product);
        } 
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        products::where('id',$id)->delete();
        return redirect()->back();
    }
}
