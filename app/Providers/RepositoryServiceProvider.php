<?php

namespace App\Providers;

use App\Repositories\Admin\Profile\ProfileUserInterface;
use App\Repositories\Admin\Profile\ProfileUserRepository;
use App\Repositories\Admin\Country\CountryInterface;
use App\Repositories\Admin\Country\CountryRepository;
use App\Repositories\Admin\Category\CategoryInterface;
use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Brand\BrandInterface;
use App\Repositories\Admin\Brand\BrandRepository;
use App\Repositories\Admin\Blog\BlogInterface;
use App\Repositories\Admin\Blog\BlogRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        [
            'abstract' => ProfileUserInterface::class,
            'concrete' => ProfileUserRepository::class,
        ],
        [
            'abstract' => CountryInterface::class,
            'concrete' => CountryRepository::class,
        ],
        [
            'abstract' => CategoryInterface::class,
            'concrete' => CategoryRepository::class,
        ],
        [
            'abstract' => BrandInterface::class,
            'concrete' => BrandRepository::class,
        ],
        [
            'abstract' => BlogInterface::class,
            'concrete' => BlogRepository::class,
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
