<?php

namespace Modules\Leads\Entities\LeadServices\Repositories;

use Modules\Leads\Entities\LeadServices\LeadService;
use Modules\Leads\Entities\LeadServices\Repositories\Interfaces\LeadServiceRepositoryInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class LeadServiceRepository implements LeadServiceRepositoryInterface
{
    // private $columns = [
    //     'id',
    //     'Leadservice',
    //     'created_at',
    //     'updated_at',
    // ];

    public function __construct(
        LeadService $Leadservice
    ) {
        $this->model = $Leadservice;
    }

    public function getAllLeadServiceNames()
    {
        try {
            return $this->model->orderBy('service', 'asc')->get(['id', 'service']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
