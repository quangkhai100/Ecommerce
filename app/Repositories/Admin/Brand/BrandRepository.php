<?php
namespace App\Repositories\Admin\Brand;

use App\Models\Brand;
use Prettus\Repository\Eloquent\BaseRepository;

class BrandRepository extends BaseRepository implements BrandInterface
{
    public function model(){
        return Brand::class;
    }
}
