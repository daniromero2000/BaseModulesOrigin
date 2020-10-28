<?php

namespace Modules\Leads\Entities\LeadAreas\Repositories;

use Modules\Leads\Entities\LeadAreas\LeadArea;
use Modules\Leads\Entities\LeadAreas\Repositories\Interfaces\LeadAreaRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LeadAreaRepository implements LeadAreaRepositoryInterface
{
    public function __construct(
        LeadArea $leadArea
    ) {
        $this->model = $leadArea;
    }

    public function createLeadArea($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadArea($params)
    {

        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadAreaById(int $id): LeadArea
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
