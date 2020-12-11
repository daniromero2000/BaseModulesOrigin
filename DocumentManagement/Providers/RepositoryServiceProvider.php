<?php

namespace Modules\DocumentManagement\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\DocumentManagement\Entities\DocumentCategories\Repositories\DocumentCategoryRepository;
use Modules\DocumentManagement\Entities\DocumentCategories\Repositories\Interfaces\DocumentCategoryRepositoryInterface;
use Modules\DocumentManagement\Entities\Documents\Repositories\DocumentRepository;
use Modules\DocumentManagement\Entities\Documents\Repositories\Interfaces\DocumentRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            DocumentRepositoryInterface::class,
            DocumentRepository::class
        );

        $this->app->bind(
            DocumentCategoryRepositoryInterface::class,
            DocumentCategoryRepository::class
        );
     
    }
}
