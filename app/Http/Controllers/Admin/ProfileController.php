<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Admin\Profile\ProfileUserInterface;
use App\Models\Country;
class ProfileController extends Controller
{
    protected $profileUserInterface;
    public function __construct( ProfileUserInterface $profileUserInterface)
    {
        $this->middleware('auth');
        $this->profileUserInterface = $profileUserInterface;
    }

    public function index()
    {
        $countries = Country::all()->toArray();

        return view('admin.user.profile.edit',compact('countries'));
    }

    public function update(UpdateProfileRequest  $request)
    {
        $data= $request->all();
        
        if( $this->profileUserInterface->updateProfileUser($data)){

            return redirect()->back()-> with('success',_('Update profile success'));
        }

        return redirect()->back()->withErrors('Update profile error,'); 
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
