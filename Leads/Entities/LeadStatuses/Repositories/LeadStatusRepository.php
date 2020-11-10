<?php

namespace Modules\Leads\Entities\LeadStatuses\Repositories;

use Modules\Leads\Entities\LeadStatuses\LeadStatus;
use Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces\LeadStatusRepositoryInterface;
use Illuminate\Database\QueryException;

class LeadStatusRepository implements LeadStatusRepositoryInterface
{
    public function __construct(LeadStatus $LeadStatus)
    {
        $this->model = $LeadStatus;
    }

    public function getAllLeadStatusesNames($select = ['*'])
    {
        try {
            return $this->model->orderBy('status', 'asc')->get($select);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLeadStatusesForServices($id)
    {
        try {
            return $this->model->where('area_id', $id)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
