<?php
namespace App\Repositories\Admin\Profile;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ProfileUserInterface extends RepositoryInterface
{
    public function updateProfileUser($data);
}
