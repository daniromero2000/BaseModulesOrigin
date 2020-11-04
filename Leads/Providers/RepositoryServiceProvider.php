<?php

namespace Modules\Leads\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Leads\Entities\LeadChannels\Repositories\Interfaces\LeadChannelRepositoryInterface;
use Modules\Leads\Entities\LeadChannels\Repositories\LeadChannelRepository;
use Modules\Leads\Entities\LeadComments\Repositories\Interfaces\LeadCommentRepositoryInterface;
use Modules\Leads\Entities\LeadComments\Repositories\LeadCommentRepository;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\LeadInformationRepository;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\LeadProductRepository;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Leads\Entities\Leads\Repositories\LeadRepository;
use Modules\Leads\Entities\LeadServices\Repositories\Interfaces\LeadServiceRepositoryInterface;
use Modules\Leads\Entities\LeadServices\Repositories\LeadServiceRepository;
use Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Modules\Leads\Entities\LeadStatuses\Repositories\LeadStatusRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            LeadRepositoryInterface::class,
            LeadRepository::class
        );

        $this->app->bind(
            LeadInformationRepositoryInterface::class,
            LeadInformationRepository::class
        );

        $this->app->bind(
            LeadStatusRepositoryInterface::class,
            LeadStatusRepository::class
        );

        $this->app->bind(
            LeadServiceRepositoryInterface::class,
            LeadServiceRepository::class
        );

        $this->app->bind(
            LeadProductRepositoryInterface::class,
            LeadProductRepository::class
        );

        $this->app->bind(
            LeadChannelRepositoryInterface::class,
            LeadChannelRepository::class
        );

        $this->app->bind(
            LeadCommentRepositoryInterface::class,
            LeadCommentRepository::class
        );
    }
}
