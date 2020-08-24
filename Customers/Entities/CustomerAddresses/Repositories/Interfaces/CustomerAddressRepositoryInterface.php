<?php

namespace Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;

interface CustomerAddressRepositoryInterface
{
    public function createCustomerAddress(array $params);

    public function deleteCustomerAddress($id);

    public function updateCustomerAddress($id);
}
