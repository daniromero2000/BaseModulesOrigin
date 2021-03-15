<?php

namespace Modules\Libranza\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\Libranza\Entities\BannerManagements\Repositories\BannerManagementRepository;
use Modules\Libranza\Entities\BannerManagements\Repositories\Interfaces\BannerManagementRepositoryInterface;
use Modules\Libranza\Entities\Covenants\Repositories\CovenantRepository;
use Modules\Libranza\Entities\Covenants\Repositories\Interfaces\CovenantRepositoryInterface;
use Modules\Libranza\Entities\Subscriptions\Repositories\Interfaces\SubscriptionRepositoryInterface;
use Modules\Libranza\Entities\Subscriptions\Repositories\SubscriptionRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CovenantRepositoryInterface::class,
            CovenantRepository::class
        );

        $this->app->bind(
            BannerManagementRepositoryInterface::class,
            BannerManagementRepository::class
        );

        $this->app->bind(
            SubscriptionRepositoryInterface::class,
            SubscriptionRepository::class
        );
    }
}
