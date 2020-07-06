<?php

namespace Modules\Customers\Providers;

use Modules\Customers\Entities\Customers\Repositories\CustomerRepository;
use Modules\Customers\Entities\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use Modules\Customers\Entities\CustomerStatuses\Repositories\CustomerStatusRepository;
use Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces\CustomerStatusRepositoryInterface;
use Modules\Customers\Entities\CustomerCommentaries\Repositories\CustomerCommentaryRepository;
use Modules\Customers\Entities\CustomerCommentaries\Repositories\Interfaces\CustomerCommentaryRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Repositories\CustomerAddressRepository;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerPhones\Repositories\CustomerPhoneRepository;
use Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces\CustomerPhoneRepositoryInterface;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\CustomerStatusesLogRepository;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Modules\Customers\Entities\CustomerEmails\Repositories\CustomerEmailRepository;
use Modules\Customers\Entities\CustomerEmails\Repositories\Interfaces\CustomerEmailRepositoryInterface;
use Modules\Customers\Entities\CustomerChannels\Repositories\CustomerChannelRepository;
use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;
use Modules\Customers\Entities\CustomerIdentities\Repositories\CustomerIdentityRepository;
use Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces\CustomerIdentityRepositoryInterface;
use Modules\Customers\Entities\CustomerVehicles\Repositories\CustomerVehicleRepository;
use Modules\Customers\Entities\CustomerVehicles\Repositories\Interfaces\CustomerVehicleRepositoryInterface;
use Modules\Customers\Entities\CustomerProfessions\Repositories\CustomerProfessionRepository;
use Modules\Customers\Entities\CustomerProfessions\Repositories\Interfaces\CustomerProfessionRepositoryInterface;
use Modules\Customers\Entities\CustomerReferences\Repositories\CustomerReferenceRepository;
use Modules\Customers\Entities\CustomerReferences\Repositories\Interfaces\CustomerReferenceRepositoryInterface;
use Modules\Customers\Entities\CustomerEpss\Repositories\CustomerEpsRepository;
use Modules\Customers\Entities\CustomerEpss\Repositories\Interfaces\CustomerEpsRepositoryInterface;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\CustomerEconomicActivityRepository;
use Modules\Customers\Entities\CustomerEconomicActivities\Repositories\Interfaces\CustomerEconomicActivityRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

        $this->app->bind(
            CustomerStatusRepositoryInterface::class,
            CustomerStatusRepository::class
        );

        $this->app->bind(
            CustomerCommentaryRepositoryInterface::class,
            CustomerCommentaryRepository::class
        );

        $this->app->bind(
            CustomerAddressRepositoryInterface::class,
            CustomerAddressRepository::class
        );

        $this->app->bind(
            CustomerPhoneRepositoryInterface::class,
            CustomerPhoneRepository::class
        );

        $this->app->bind(
            CustomerStatusesLogRepositoryInterface::Class,
            CustomerStatusesLogRepository::class
        );

        $this->app->bind(
            CustomerEmailRepositoryInterface::Class,
            CustomerEmailRepository::class
        );

        $this->app->bind(
            CustomerEmailRepositoryInterface::Class,
            CustomerEmailRepository::class
        );

        $this->app->bind(
            CustomerChannelRepositoryInterface::Class,
            CustomerChannelRepository::class
        );

        $this->app->bind(
            CustomerIdentityRepositoryInterface::Class,
            CustomerIdentityRepository::class
        );

        $this->app->bind(
            CustomerVehicleRepositoryInterface::Class,
            CustomerVehicleRepository::class
        );

        $this->app->bind(
            CustomerProfessionRepositoryInterface::Class,
            CustomerProfessionRepository::class
        );

        $this->app->bind(
            CustomerReferenceRepositoryInterface::Class,
            CustomerReferenceRepository::class
        );


        $this->app->bind(
            CustomerEpsRepositoryInterface::Class,
            CustomerEpsRepository::class
        );

        $this->app->bind(
            CustomerEconomicActivityRepositoryInterface::Class,
            CustomerEconomicActivityRepository::class
        );
    }
}
