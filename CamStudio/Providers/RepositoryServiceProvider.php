<?php

namespace Modules\CamStudio\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\CammodelCategoryRepository;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\CammodelBannedCountryRepository;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CammodelBannedCountryInterface::class,
            CammodelBannedCountryRepository::class
        );

        $this->app->bind(
            CammodelRepositoryInterface::class,
            CammodelRepository::class
        );

        $this->app->bind(
            CammodelCategoryRepositoryInterface::class,
            CammodelCategoryRepository::class
        );
    }
}