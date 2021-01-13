<?php

namespace Modules\CallCenter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CallCenter\Entities\CampaignBases\Repositories\CallCenterCampaignBaseRepository;
use Modules\CallCenter\Entities\CampaignBases\Repositories\Interfaces\CallCenterCampaignBaseRepositoryInterface;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\CallCenterCampaignRequestRepository;
use Modules\CallCenter\Entities\CampaignRequests\Repositories\Interfaces\CallCenterCampaignRequestRepositoryInterface;
use Modules\CallCenter\Entities\Campaigns\Repositories\CallCenterCampaignRepository;
use Modules\CallCenter\Entities\Campaigns\Repositories\Interfaces\CallCenterCampaignRepositoryInterface;
use Modules\CallCenter\Entities\Scripts\Repositories\CallCenterScriptRepository;
use Modules\CallCenter\Entities\Scripts\Repositories\Interfaces\CallCenterScriptRepositoryInterface;

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

        $this->app->bind(
            CallCenterCampaignRepositoryInterface::class,
            CallCenterCampaignRepository::class
        );

        $this->app->bind(
            CallCenterScriptRepositoryInterface::class,
            CallCenterScriptRepository::class
        );
    }
}
