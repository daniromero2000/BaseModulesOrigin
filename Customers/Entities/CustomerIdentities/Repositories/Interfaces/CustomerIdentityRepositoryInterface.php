<?php

namespace Modules\Customers\Entities\CustomerIdentities\Repositories\Interfaces;

interface CustomerIdentityRepositoryInterface
{
    public function createCustomerIdentity(array $params);

    public function checkIfExists($data);
}
