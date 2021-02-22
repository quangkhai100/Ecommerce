<?php
namespace App\Repositories\Admin\Category;

use App\Models\Category;
use Prettus\Repository\Eloquent\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function model(){
        return Category::class;
    }
}
