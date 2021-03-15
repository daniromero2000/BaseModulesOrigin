<?php

namespace Modules\Libranza\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Libranza\Entities\BannerManagements\Services\BannerManagementService;
use Modules\Libranza\Entities\BannerManagements\Services\Interfaces\BannerManagementServiceInterface;
use Modules\Libranza\Entities\Subscriptions\Services\Interfaces\SubscriptionServiceInterface;
use Modules\Libranza\Entities\Subscriptions\Services\SubscriptionService;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BannerManagementServiceInterface::class,
            BannerManagementService::class
        );

        $this->app->bind(
            SubscriptionServiceInterface::class,
            SubscriptionService::class
        );
    }
}
