<?php

namespace Modules\Companies\Entities\Employees\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Exceptions\CreateEmployeeErrorException;
use Modules\Companies\Entities\Employees\Exceptions\EmployeeNotFoundException;
use Modules\Companies\Entities\Employees\Exceptions\UpdateEmployeeErrorException;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'last_name',
        'email',
        'rh',
        'bank_account',
        'work_schedule',
        'admission_date',
        'subsidiary_id',
        'employee_position_id',
        'is_active',
    ];

    private $listColumns = [
        'id',
        'name',
        'last_name',
        'email',
        'rh',
        'bank_account',
        'work_schedule',
        'admission_date',
        'subsidiary_id',
        'employee_position_id',
        'is_active',
        'is_rotative',
        'birthday',
    ];

    private $employeeColumns = [
        'id',
        'name',
        'last_name',
        'email',
        'rh',
        'bank_account',
        'work_schedule',
        'admission_date',
        'subsidiary_id',
        'employee_position_id',
        'is_active',
        'last_login_at',
        'is_rotative',
        'birthday',
    ];

    public function __construct(Employee $employee)
    {
        $this->model = $employee;
    }

    public function listEmployees(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('name', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchEmployee(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchEmployee($text)->get($this->columns);
    }

    public function searchTrashedEmployee(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createEmployee(array $data): Employee
    {
        try {
            $data['password'] = Hash::make($data['password']);

            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateEmployeeErrorException($e);
        }
    }

    public function findEmployeeById(int $id): Employee
    {
        try {
            return $this->model->with([
                'employeeCommentaries',
                'department',
                'subsidiary',
                'employeeStatusesLogs',
                'employeePosition',
                'employeeEmails',
                'employeePhones',
                'employeeAddresses',
                'employeeEmergencyContact',
                'employeeIdentities',
                'employeeEpss',
                'employeeProfessions',
            ])->findOrFail($id, $this->employeeColumns);
        } catch (ModelNotFoundException $e) {
            throw new EmployeeNotFoundException($e);
        }
    }

    public function findTrashedEmployeeById(int $id): Employee
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new EmployeeNotFoundException($e);
        }
    }

    public function updateEmployee(array $params): bool
    {
        try {
            if (isset($params['password'])) {
                $params['password'] = Hash::make($params['password']);
            }

            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateEmployeeErrorException($e);
        }
    }

    public function syncRoles(array $roleIds)
    {
        try {
            $this->model->roles()->sync($roleIds);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function hasRole(string $roleName): bool
    {
        return $this->model->hasRole($roleName);
    }

    public function isAuthUser(Employee $employee): bool
    {
        $isAuthUser = false;
        if (Auth::guard('employee')->user()->id == $employee->id) {
            $isAuthUser = true;
        }

        return $isAuthUser;
    }

    public function deleteEmployee(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedEmployee(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
