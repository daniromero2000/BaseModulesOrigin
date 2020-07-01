<?php

namespace Modules\Customers\Entities\CustomerPhones\Repositories\Interfaces;

interface CustomerPhoneRepositoryInterface
{
    public function createCustomerPhone(array $params);

    public function checkIfExists($data);
}
