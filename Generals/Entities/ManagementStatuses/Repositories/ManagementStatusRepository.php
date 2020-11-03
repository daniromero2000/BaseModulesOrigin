<?php

namespace Modules\Generals\Entities\ManagementStatuses\Repositories;

use Illuminate\Database\QueryException;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;
use Modules\Generals\Entities\ManagementStatuses\Repositories\Interfaces\ManagementStatusRepositoryInterface;

class ManagementStatusRepository implements ManagementStatusRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        ManagementStatus $managementStatus
    ) {
        $this->model = $managementStatus;
    }

    public function getStatusesForType($type)
    {
        try {
            return $this->model->where('type_management_status', $type)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
