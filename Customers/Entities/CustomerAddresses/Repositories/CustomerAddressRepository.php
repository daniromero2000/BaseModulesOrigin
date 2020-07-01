<?php

namespace Modules\Customers\Entities\CustomerAddresses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\CustomerAddresses\Repositories\Interfaces\CustomerAddressRepositoryInterface;
use Modules\Customers\Entities\CustomerAddresses\Exceptions\CreateAddressErrorException;
use Modules\Customers\Entities\CustomerAddresses\Exceptions\AddressNotFoundException;
use Illuminate\Database\QueryException;

class CustomerAddressRepository implements CustomerAddressRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(CustomerAddress $customerAddress)
    {
        $this->model = $customerAddress;
    }

    public function createCustomerAddress(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findAddressById(int $id): CustomerAddress
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new AddressNotFoundException('Address not found.');
        }
    }
}
