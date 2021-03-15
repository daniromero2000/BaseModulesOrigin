<?php

namespace Modules\Libranza\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Libranza\Entities\BannerManagements\Services\BannerManagementService;
use Modules\Libranza\Entities\BannerManagements\Services\Interfaces\BannerManagementServiceInterface;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            BannerManagementServiceInterface::class,
            BannerManagementService::class
        );
    }
}
