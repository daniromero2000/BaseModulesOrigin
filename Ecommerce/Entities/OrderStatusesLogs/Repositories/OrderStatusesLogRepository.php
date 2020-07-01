<?php

namespace Modules\Customers\Entities\OrderStatusesLogs\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
use Modules\Ecommerce\Entities\OrderStatusesLogs\OrderStatusesLog;
use Modules\Ecommerce\Entities\OrderStatusesLogs\Repositories\Interfaces\OrderStatusesLogRepositoryInterface;
use Carbon\CarbonInterval;

class OrderStatusesLogRepository implements OrderStatusesLogRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        OrderStatusesLog $orderStatusesLog
    ) {
        $this->model = $orderStatusesLog;
    }

    public function createOrderStatusesLog(array $attributes): OrderStatusesLog
    {
        try {
            $orderStatusesLog = new OrderStatusesLog($attributes);
            $orderCreatedAt    = $orderStatusesLog->customer->created_at;
            $orderStatusesLog->time_passed = $this->customerStatusDaysPassed($orderCreatedAt);
            $orderStatusesLog->save();

            return $orderStatusesLog;
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    private function customerStatusDaysPassed($orderCreatedAt)
    {
        return CarbonInterval::seconds($orderCreatedAt->diffInSeconds(Carbon::now()))->cascade()->forHumans();
    }
}
