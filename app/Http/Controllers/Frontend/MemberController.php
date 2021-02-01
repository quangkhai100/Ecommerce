<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateProfileRequest;
Use App\User;
use Auth;
Use App\Countries;
use App\Http\Requests\MemberLoginRequest;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexRegister()
    {
      
        $countries = countries::all()->toArray();
        return view('frontend/pages/register',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RegisterRequest $request)
    {
        $countries = countries::all()->toArray();
        $data = $request->all();
        $file = $request->avatar;
        //check avatar
      
        $data['password']=bcrypt($data['password']);
        $data['level']=0;
        $data['countries']=$_POST['country'];
        $members = new User();
        $members->name = $data['name'];
        $members->email = $data['email'];
        $members->password = $data['password'];
        $members->phone = $data['phone'];
        if(!empty($file)){
            $file->move('avatar/img',$file->getClientOriginalName());
            $data['avatar']=$file->getClientOriginalName();
            $members->avatar = $data['avatar'];
        }
        $members->level = $data['level'];
        $members->id_country = $data['countries'];
        $members->save();
        return view('frontend/pages/register', compact('countries'));
        // return redirect()->view('frontend/pages/register', compact('countries'));
    }

    public function indexlogin(){
        return view('frontend/pages/login');
    }
    
    public function login(MemberLoginRequest $request){

        $login=[
            "email"=>$request->email,
            "password"=>$request->password,
            'level'=>0
        ];

        $remember=false;
        
        if ($request->rememer_me){
            $remember=true;
        }

        if (Auth::attempt($login,$remember)){
            return redirect('/');
        }
        else {
            return redirect()->back()->withErrors('Email or password is not correct.');
        }
    }
    public function logOut(){
        Auth::logout();
        return redirect('/member/login');
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
        $countries = countries::all()->toArray();
        return view("frontend/pages/account",compact('countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request, $id)
    {
        $userId= Auth::id();
        $user = User::findOrFail($userId);
        $data = $request->all(); //lay all value
        $file = $request->avatar;
        //check avatar
        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        
        //check password
        if ($data['password'] && $data['password']=$data['password-c']){
            $data['password']=bcrypt($data['password']);
        }
        else{
            $data['password']=$user->password;
        }
       
        if($user->update($data)){
            if(!empty($file)){
                $file->move('avatar/img',$file->getClientOriginalName());
                $user->avatar=$file->getClientOriginalName();
            }
           
            return redirect()->back()-> with('success',_('Update profile success'));
        }
        else {
            return redirect()->back()->withErrors('Update profile error,'); 
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
        //
    }
}
