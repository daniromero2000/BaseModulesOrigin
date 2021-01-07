<?php

namespace Modules\CallCenter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\CallCenter\Entities\CampaignBases\Services\CallCenterCampaignBaseService;
use Modules\CallCenter\Entities\CampaignBases\Services\Interfaces\CallCenterCampaignBaseServiceInterface;
use Modules\CallCenter\Entities\CampaignRequests\Services\CallCenterCampaignRequestService;
use Modules\CallCenter\Entities\CampaignRequests\Services\Interfaces\CallCenterCampaignRequestServiceInterface;

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
