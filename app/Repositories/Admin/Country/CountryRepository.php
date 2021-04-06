<?php
namespace App\Repositories\Admin\Country;

use App\Models\Country;
use Prettus\Repository\Eloquent\BaseRepository;

class CountryRepository extends BaseRepository implements CountryInterface
{
    public function model(){
        return Country::class;
    }
}
