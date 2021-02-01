<?php

namespace App\Http\Controllers\Frontend;

use App\History;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use Auth;
use Mail;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $array=array();
        if (session()->has('produc')){
        $a = session()->get('produc'); 
        foreach (session()->get('produc') as $key => $value) {
            array_push($array,$value['id']);
        }
    }
        $products = products::whereIn('id',$array)->get();
        if (session()->has('produc')){
            foreach($products as $key => $value ){
                foreach (session()->get('produc') as $i) {
                    if ($value['id'] == $i['id']) {
                        $products[$key]['quality'] = $i['quality'];
                            }
                        }
            }
            }
        return view('frontend/pages/cart',compact('products'));
    }
    public function caculate()
    {
        $getId = $_POST['productId'];
        $qtyUpdate = $_POST['qtyUpdate'];
        $a = session()->get('produc'); 
        if (session()->has('produc')){
            foreach ( $a as $key => $value) {
                if ($value['id'] == $getId) {
                    $a[$key]['quality'] = $qtyUpdate;
                    session()->put('produc', $a);
                }
            }
        }
    }
    public function delete(){
        $deleteProduct= $_POST['deleteProduct'];
        $a = session()->get('produc'); 
        if (session()->has('produc')){
            foreach($a as $key => $value){
            if ($value['id']==$deleteProduct){
                unset($a[$key]);
                session()->put('produc', $a);
            }
    }} 
    }
    
    public function checkout(Request $request){
        $userId= Auth::id();
        $history= new History();
        $history->name=Auth::user()->name;
        $history->email=Auth::user()->email;
        $history->phone=Auth::user()->phone;
        $history->price=$request->price;
        $history->user_id= $userId;
        $history->save();
        
        $array=array();
        if (session()->has('produc')){
        $a = session()->get('produc'); 
        foreach (session()->get('produc') as $key => $value) {
            array_push($array,$value['id']);
        }
    }
        $products = products::whereIn('id',$array)->get();
        if (session()->has('produc')){
            foreach($products as $key => $value ){
                foreach (session()->get('produc') as $i) {
                    if ($value['id'] == $i['id']) {
                        $products[$key]['quality'] = $i['quality'];
                            }
                        }
            }
            }
        $subject = 'Email Subject';
        $to = 'khai.nguyenquangitman@gmail.com';
        Mail::send('emails.email', 
        [
            'products' =>  $products, 
            'userId'=>Auth::id(),
            ], 
            function ($message) use ($subject, $to){
            $message->from('cumeo1998superman123@gmail.com', 'Products detail');
            $message->to('khai.nguyenquangitman@gmail.com');
            $message->subject('Email Subject');
         });

        return redirect()->back();
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
