<?php

namespace Modules\Customers\Entities\CustomerStatuses\Repositories\Interfaces;

use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;

interface CustomerStatusRepositoryInterface
{
    public function createCustomerStatus(array $customerStatusData);

    public function updateCustomerStatus(array $data): bool;

    public function findCustomerStatusById(int $id): CustomerStatus;

    public function listCustomerStatuses();

    public function deleteCustomerStatus(): bool;
}
