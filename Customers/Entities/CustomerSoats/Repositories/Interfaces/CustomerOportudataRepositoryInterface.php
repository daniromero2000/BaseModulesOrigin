<?php

namespace Modules\Customers\Entities\CustomersOportudata\Repositories\Interfaces;

use Modules\Customers\Entities\CustomersOportudata\CustomerOportudata;
use Illuminate\Database\Eloquent\Collection;


interface CustomerOportudataRepositoryInterface
{
    public function listCustomers($totalView);

    public function createCustomer(array $params): CustomerOportudata;

    public function updateCustomer(array $params): bool;

    public function findCustomerById(int $id): CustomerOportudata;

    public function findFrontCustomerById(int $id): CustomerOportudata;

    public function findTrashedCustomerById(int $id): CustomerOportudata;

    public function deleteCustomer(): bool;

    public function searchCustomer(string $text = null): Collection;

    public function searchTrashedCustomer(string $text = null): Collection;

    public function recoverTrashedCustomer(): bool;

    public function sendEmailToCustomer($customer);

    public function sendEmailNotificationToAdmin($customer);

    public function checkForLogin($email);

    public function findOrders($columns = ['*'], string $orderBy = 'id'): Collection;

    public function findCustomerByIdforShipment(int $id): CustomerOportudata;
}
