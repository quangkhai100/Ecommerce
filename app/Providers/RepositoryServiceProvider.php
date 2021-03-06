<?php

namespace App\Providers;

use App\Repositories\Admin\Profile\ProfileUserInterface;
use App\Repositories\Admin\Profile\ProfileUserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        [
            'abstract' => ProfileUserInterface::class,
            'concrete' => ProfileUserRepository::class,
        ],
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $repository) {
            $this->app->bind($repository['abstract'], $repository['concrete']);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
