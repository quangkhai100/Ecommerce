<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Admin\Country\CountryInterface;
use App\Models\Country;

class CountryController extends Controller
{  
    protected $countryInterface;

    public function __construct(CountryInterface $countryInterface)
    {
        $this->middleware('auth');
        $this->countryInterface = $countryInterface;
    }

    public function index()
    {
        $countries = $this->countryInterface->paginate(config('pagesnumber.pages_number'));
        return view("admin.user.country.index",compact('countries'));
    }

    public function create()
    {
        return view('admin.user.country.create');
    }

    public function store(Request $request)
    {
        $data = $request->only('countryName');

        if ($this->countryInterface->create($data)){

            return redirect()->back()->with('successed', 'created success');
        }

        return redirect()->back()->with('failed', 'created fail');    
    }

    public function edit(Country $country)
    {
        return view('admin.user.country.edit',compact('country'));
    }

   
    public function update(Request $request, $id)
    {

        $countries = Country::find($id);
        $countries->name=$request->countryName;
        $countries->save();
        return view('admin/user/update');

    }

    
    public function destroy(Request $request)
    {
        Country::where('id',$request->id)->delete();
        $countries = countries::all()->toArray();
        return view("admin/user/country",compact('countries'));

    }
}
