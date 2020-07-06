<?php

namespace Modules\Companies\Entities\EmployeePhones\Repositories\Interfaces;

interface EmployeePhoneRepositoryInterface
{
    public function createEmployeePhone(array $params);

    public function checkIfExists($data);
}
