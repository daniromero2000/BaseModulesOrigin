<?php

namespace Modules\CallCenter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CallCenter\Entities\CampaignBases\Repositories\CallCenterCampaignBaseRepository;
use Modules\CallCenter\Entities\CampaignBases\Repositories\Interfaces\CallCenterCampaignBaseRepositoryInterface;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\CallCenterCampaignRequestRepository;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\Interfaces\CallCenterCampaignRequestRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CallCenterCampaignRequestRepositoryInterface::class,
            CallCenterCampaignRequestRepository::class
        );

        $this->app->bind(
            CallCenterCampaignBaseRepositoryInterface::class,
            CallCenterCampaignBaseRepository::class
        );
    }
}
