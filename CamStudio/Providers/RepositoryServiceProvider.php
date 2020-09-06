<?php

namespace Modules\CamStudio\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CammodelRepositoryInterface::class,
            CammodelRepository::class
        );
    }
}
