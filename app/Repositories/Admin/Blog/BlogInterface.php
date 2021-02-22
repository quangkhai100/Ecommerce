<?php
namespace App\Repositories\Admin\Blog;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BlogInterface extends RepositoryInterface
{
    public function createBlog($data);
    public function updateBlog($data, $id);
}
