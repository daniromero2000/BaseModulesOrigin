<?php

namespace Modules\CallCenter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CallCenter\Entities\CampaignBases\Services\CallCenterCampaignBaseService;
use Modules\CallCenter\Entities\CampaignBases\Services\Interfaces\CallCenterCampaignBaseServiceInterface;
use Modules\CallCenter\Entities\CampaignRequests\Services\CallCenterCampaignRequestService;
use Modules\CallCenter\Entities\CampaignRequests\Services\Interfaces\CallCenterCampaignRequestServiceInterface;
use Modules\CallCenter\Entities\Campaigns\Services\CallCenterCampaignService;
use Modules\CallCenter\Entities\Campaigns\Services\Interfaces\CallCenterCampaignServiceInterface;
use Modules\CallCenter\Entities\Scripts\Services\CallCenterScriptService;
use Modules\CallCenter\Entities\Scripts\Services\Interfaces\CallCenterScriptServiceInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CallCenterCampaignRequestServiceInterface::class,
            CallCenterCampaignRequestService::class
        );

        $this->app->bind(
            CallCenterCampaignBaseServiceInterface::class,
            CallCenterCampaignBaseService::class
        );

        $this->app->bind(
            CallCenterCampaignServiceInterface::class,
            CallCenterCampaignService::class
        );

        $this->app->bind(
            CallCenterScriptServiceInterface::class,
            CallCenterScriptService::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
