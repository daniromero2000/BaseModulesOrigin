<?php

namespace Modules\Companies\Providers;

use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\Permissions\Repositories\PermissionRepository;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Companies\Entities\Departments\Repositories\DepartmentRepository;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\Actions\Repositories\ActionRepository;
use Modules\Companies\Entities\EmployeePositions\Repositories\EmployeePositionRepository;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\EmployeeCommentaryRepository;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\EmployeeStatusesLogRepository;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmails\Repositories\EmployeeEmailRepository;
use Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces\EmployeeEmailRepositoryInterface;
use Modules\Companies\Entities\EmployeePhones\Repositories\EmployeePhoneRepository;
use Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces\EmployeePhoneRepositoryInterface;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\EmployeeAddressRepository;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\EmployeeIdentityRepository;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces\EmployeeIdentityRepositoryInterface;
use Modules\Companies\Entities\EmployeeEpss\Repositories\EmployeeEpsRepository;
use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Modules\Companies\Entities\EmployeeProfessions\Repositories\EmployeeProfessionRepository;
use Modules\Companies\Entities\EmployeeProfessions\Repositories\Interfaces\EmployeeProfessionRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            SubsidiaryRepositoryInterface::class,
            SubsidiaryRepository::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );

        $this->app->bind(
            DepartmentRepositoryInterface::class,
            DepartmentRepository::class
        );

        $this->app->bind(
            ActionRepositoryInterface::class,
            ActionRepository::class
        );

        $this->app->bind(
            EmployeePositionRepositoryInterface::class,
            EmployeePositionRepository::class
        );

        $this->app->bind(
            VehicleBrandRepositoryInterface::Class,
            VehicleBrandRepository::class
        );

        $this->app->bind(
            VehicleTypeRepositoryInterface::Class,
            VehicleTypeRepository::class
        );

        $this->app->bind(
            EconomicActivityTypeRepositoryInterface::Class,
            EconomicActivityTypeRepository::class
        );

        $this->app->bind(
            EmployeeCommentaryRepositoryInterface::Class,
            EmployeeCommentaryRepository::class
        );

        $this->app->bind(
            EmployeeStatusesLogRepositoryInterface::Class,
            EmployeeStatusesLogRepository::class
        );

        $this->app->bind(
            EmployeeEmailRepositoryInterface::Class,
            EmployeeEmailRepository::class
        );

        $this->app->bind(
            EmployeePhoneRepositoryInterface::Class,
            EmployeePhoneRepository::class
        );

        $this->app->bind(
            EmployeeIdentityRepositoryInterface::Class,
            EmployeeIdentityRepository::class
        );

        $this->app->bind(
            EmployeeAddressRepositoryInterface::Class,
            EmployeeAddressRepository::class
        );

        $this->app->bind(
            EmployeeEpsRepositoryInterface::Class,
            EmployeeEpsRepository::class
        );

        $this->app->bind(
            EmployeeProfessionRepositoryInterface::Class,
            EmployeeProfessionRepository::class
        );
    }
}
