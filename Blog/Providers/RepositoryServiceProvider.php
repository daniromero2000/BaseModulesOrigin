<?php

namespace Modules\Blog\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Blog\Entities\WinkPosts\Repositories\WinkPostRepository;
use Modules\Blog\Entities\WinkPosts\Repositories\Interfaces\WinkPostRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            WinkPostRepositoryInterface::class,
            WinkPostRepository::class
        );
    }
}
