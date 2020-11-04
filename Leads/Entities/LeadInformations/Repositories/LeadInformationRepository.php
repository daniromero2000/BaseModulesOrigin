<?php

namespace Modules\Leads\Entities\LeadInformations\Repositories;

use Modules\Leads\Entities\LeadInformations\LeadInformation;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LeadInformationRepository implements LeadInformationRepositoryInterface
{
    public function __construct(
        LeadInformation $LeadInformation
    ) {
        $this->model = $LeadInformation;
    }

    public function createLeadInformation($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadInformation($id, $data)
    {
        try {
            return $this->model->updateOrCreate(['lead_id' => $id], $data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findLeadInformationById(int $id): LeadInformation
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
