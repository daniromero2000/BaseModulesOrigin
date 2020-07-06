<?php

namespace Modules\Customers\Entities\CustomerChannels\Repositories;

use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Modules\Customers\Entities\CustomerChannels\Repositories\Interfaces\CustomerChannelRepositoryInterface;
use Illuminate\Database\QueryException;


class CustomerChannelRepository implements CustomerChannelRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CustomerChannel $customerChannel
    ) {
        $this->model = $customerChannel;
    }

    public function getAllCustomerChannelNames()
    {
        try {
            return $this->model->get(['id', 'channel']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
