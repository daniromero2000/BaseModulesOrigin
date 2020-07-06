<?php

namespace Modules\Customers\Entities\CustomerStatusesLogs\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
use Modules\Customers\Entities\CustomerStatusesLogs\Repositories\Interfaces\CustomerStatusesLogRepositoryInterface;
use Carbon\CarbonInterval;

class CustomerStatusesLogRepository implements CustomerStatusesLogRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        CustomerStatusesLog $customerStatusesLog
    ) {
        $this->model = $customerStatusesLog;
    }

    public function createCustomerStatusesLog(array $attributes): CustomerStatusesLog
    {
        try {
            $customerStatusesLog = new CustomerStatusesLog($attributes);
            $customerCreatedAt    = $customerStatusesLog->customer->created_at;
            $customerStatusesLog->time_passed = $this->customerStatusDaysPassed($customerCreatedAt);
            $customerStatusesLog->save();

            return $customerStatusesLog;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    private function customerStatusDaysPassed($customerCreatedAt)
    {
        return CarbonInterval::seconds($customerCreatedAt->diffInSeconds(Carbon::now()))->cascade()->forHumans();
    }
}
