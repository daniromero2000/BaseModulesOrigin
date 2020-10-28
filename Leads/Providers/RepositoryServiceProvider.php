<?php

namespace Modules\Leads\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Leads\Entities\LeadAreas\Repositories\Interfaces\LeadAreaRepositoryInterface;
use Modules\Leads\Entities\LeadAreas\Repositories\LeadAreaRepository;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Leads\Entities\Leads\Repositories\LeadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadRepositoryInterface::class,
            LeadRepository::class
        );

        $this->app->bind(
            LeadAreaRepositoryInterface::class,
            LeadAreaRepository::class
        );
    }
}
