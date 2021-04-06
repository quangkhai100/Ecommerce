<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Repositories\Admin\Profile\ProfileUserInterface;
use App\Repositories\Admin\Country\CountryInterface;
use App\Models\Country;
class ProfileController extends Controller
{
    protected $countryInterface;
    protected $profileUserInterface;

    public function __construct(ProfileUserInterface $profileUserInterface, CountryInterface $countryInterface)
    {
        $this->middleware('auth');
        $this->profileUserInterface = $profileUserInterface;
        $this->countryInterface = $countryInterface;
    }

    public function index()
    {
        $countries = $this->countryInterface->all();

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

}
