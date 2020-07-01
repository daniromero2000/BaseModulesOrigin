<?php

namespace Modules\Companies\Entities\EmployeeIdentities\Repositories\Interfaces;

interface EmployeeIdentityRepositoryInterface
{
    public function createEmployeeIdentity(array $params);

    public function checkIfExists($data);
}
