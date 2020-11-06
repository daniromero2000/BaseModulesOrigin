<?php

namespace Modules\Companies\Entities\Employees\Repositories\Interfaces;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Support\Collection;

interface EmployeeRepositoryInterface
{
    public function listEmployees(int $totalView, $company);

    public function createEmployee(array $params): Employee;

    public function findEmployeeById(int $id): Employee;

    public function findTrashedEmployeeById(int $id): Employee;

    public function updateEmployee(array $params): bool;

    public function syncRoles(array $roleIds);

    public function hasRole(string $roleName): bool;

    public function isAuthUser(Employee $employee): bool;

    public function searchEmployee(string $text = null, $company, int $totalView, $from = null, $to = null): Collection;

    public function countEmployees(string $text = null, $company,  $from = null, $to = null);

    public function searchTrashedEmployee(string $text = null): Collection;

    public function deleteEmployee(): bool;

    public function recoverTrashedEmployee(): bool;
}
