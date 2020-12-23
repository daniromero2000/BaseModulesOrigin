<?php

namespace Modules\Companies\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Companies\Entities\Actions\Repositories\ActionRepository;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Modules\Companies\Entities\Companies\Repositories\CompanyRepository;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Companies\Entities\Departments\Repositories\DepartmentRepository;
use Modules\Companies\Entities\Departments\Repositories\Interfaces\DepartmentRepositoryInterface;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\EmployeeAddressRepository;
use Modules\Companies\Entities\EmployeeAddresses\Repositories\Interfaces\EmployeeAddressRepositoryInterface;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\EmployeeCommentaryRepository;
use Modules\Companies\Entities\EmployeeCommentaries\Repositories\Interfaces\EmployeeCommentaryRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmails\Repositories\EmployeeEmailRepository;
use Modules\Companies\Entities\EmployeeEmails\Repositories\Interfaces\EmployeeEmailRepositoryInterface;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\EmployeeEmergencyContactRepository;
use Modules\Companies\Entities\EmployeeEmergencyContacts\Repositories\Interfaces\EmployeeEmergencyContactRepositoryInterface;
use Modules\Companies\Entities\EmployeeEpss\Repositories\EmployeeEpsRepository;
use Modules\Companies\Entities\EmployeeEpss\Repositories\Interfaces\EmployeeEpsRepositoryInterface;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\EmployeeIdentityRepository;
use Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces\EmployeeIdentityRepositoryInterface;
use Modules\Companies\Entities\EmployeePhones\Repositories\EmployeePhoneRepository;
use Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces\EmployeePhoneRepositoryInterface;
use Modules\Companies\Entities\EmployeePositions\Repositories\EmployeePositionRepository;
use Modules\Companies\Entities\EmployeePositions\Repositories\Interfaces\EmployeePositionRepositoryInterface;
use Modules\Companies\Entities\EmployeeProfessions\Repositories\EmployeeProfessionRepository;
use Modules\Companies\Entities\EmployeeProfessions\Repositories\Interfaces\EmployeeProfessionRepositoryInterface;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\EmployeeStatusesLogRepository;
use Modules\Companies\Entities\EmployeeStatusesLogs\Repositories\Interfaces\EmployeeStatusesLogRepositoryInterface;
use Modules\Companies\Entities\Permissions\Repositories\Interfaces\PermissionRepositoryInterface;
use Modules\Companies\Entities\Permissions\Repositories\PermissionRepository;
use Modules\Companies\Entities\Roles\Repositories\Interfaces\RoleRepositoryInterface;
use Modules\Companies\Entities\Roles\Repositories\RoleRepository;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Modules\Companies\Entities\Subsidiaries\Repositories\SubsidiaryRepository;
use Modules\Companies\Entities\InterviewStatuses\Repositories\Interfaces\InterviewStatusRepositoryInterface;
use Modules\Companies\Entities\InterviewStatuses\Repositories\InterviewStatusRepository;
use Modules\Companies\Entities\Interviews\Repositories\Interfaces\InterviewRepositoryInterface;
use Modules\Companies\Entities\Interviews\Repositories\InterviewRepository;
use Modules\Companies\Entities\Notifications\Repositories\Interfaces\NotificationRepositoryInterface;
use Modules\Companies\Entities\Notifications\Repositories\NotificationRepository;
class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            InterviewRepositoryInterface::class,
            InterviewRepository::class
        );

        $this->app->bind(
            InterviewStatusRepositoryInterface::class,
            InterviewStatusRepository::class
        );

        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            CompanyRepositoryInterface::class,
            CompanyRepository::class
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
            VehicleBrandRepositoryInterface::class,
            VehicleBrandRepository::class
        );

        $this->app->bind(
            VehicleTypeRepositoryInterface::class,
            VehicleTypeRepository::class
        );

        $this->app->bind(
            EconomicActivityTypeRepositoryInterface::class,
            EconomicActivityTypeRepository::class
        );

        $this->app->bind(
            EmployeeCommentaryRepositoryInterface::class,
            EmployeeCommentaryRepository::class
        );

        $this->app->bind(
            EmployeeStatusesLogRepositoryInterface::class,
            EmployeeStatusesLogRepository::class
        );

        $this->app->bind(
            EmployeeEmailRepositoryInterface::class,
            EmployeeEmailRepository::class
        );

        $this->app->bind(
            EmployeePhoneRepositoryInterface::class,
            EmployeePhoneRepository::class
        );

        $this->app->bind(
            EmployeeIdentityRepositoryInterface::class,
            EmployeeIdentityRepository::class
        );

        $this->app->bind(
            EmployeeAddressRepositoryInterface::class,
            EmployeeAddressRepository::class
        );

        $this->app->bind(
            EmployeeEpsRepositoryInterface::class,
            EmployeeEpsRepository::class
        );

        $this->app->bind(
            EmployeeProfessionRepositoryInterface::class,
            EmployeeProfessionRepository::class
        );
        
        $this->app->bind(
            EmployeeEmergencyContactRepositoryInterface::class,
            EmployeeEmergencyContactRepository::class
        );

        $this->app->bind(
            NotificationRepositoryInterface::class,
            NotificationRepository::class
        );
    }
}
