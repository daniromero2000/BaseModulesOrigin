<?php

namespace Modules\CallCenter\Providers;

use Illuminate\Support\ServiceProvider;
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
