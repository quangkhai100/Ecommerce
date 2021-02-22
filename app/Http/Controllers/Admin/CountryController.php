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
        $data = $request->only('name');

        if ($this->countryInterface->create($data)){

            return redirect()->back()->with('successed', 'created success');
        }

        return redirect()->back()->with('failed', 'created fail');    
    }

    public function edit(Country $country)
    {
        return view('admin.user.country.edit',compact('country'));
    }

   
    public function update(Request $request, Country $country)
    {
        $data = $request->only('name');

        if ($this->countryInterface->update($data, $country->id)) {

            return redirect()->back()->with('success', 'Update Succeed');
        }
        return redirect()->back()->withErrors('Update Failed');
    }

    
    public function destroy(Country $country)
    {
        if ($this->countryInterface->delete($country->id)){

            return redirect(route('country.index'));
        }
            return redirect()->back()->withErrors('Update Failed');
    }
}
