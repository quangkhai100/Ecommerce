<?php

namespace App\Repositories\Admin\Blog;

use App\Models\Blog;
use Prettus\Repository\Eloquent\BaseRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogRepository extends BaseRepository implements BlogInterface
{
    public function model()
    {
        return Blog::class;
    }

    public function createBlog($data)
    {
        if (isset($data['image'])) {
            $fileName = Str::uuid() . '.' . $data['image']->getClientOriginalExtension();
            Storage::disk('local')->put($fileName, file_get_contents($data['image']), 'public');
            $data['image'] = $fileName;
        }
        $this->model->create($data);
    }

    public function updateBlog($data, $id)
    {
        $model = $this->model->find($id);
        if (isset($data['image'])) {
            $fileName = Str::uuid() . '.' . $data['image']->getClientOriginalExtension();
            Storage::disk('local')->put($fileName, file_get_contents($data['image']), 'public');
            $data['image'] = $fileName;;
        }
        $model->update($data);
    }
}
