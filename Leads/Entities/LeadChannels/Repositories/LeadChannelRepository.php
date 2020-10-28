<?php

namespace Modules\Leads\Entities\LeadChannels\Repositories;

use Modules\Leads\Entities\LeadChannels\LeadChannel;
use Modules\Leads\Entities\LeadChannels\Repositories\Interfaces\LeadChannelRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class LeadChannelRepository implements LeadChannelRepositoryInterface
{
    public function __construct(
        LeadChannel $LeadChannel
    ) {
        $this->model = $LeadChannel;
    }

    public function createLeadChannel($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadChannel($params)
    {

        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadChannelById(int $id): LeadChannel
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
