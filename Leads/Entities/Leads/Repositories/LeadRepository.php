<?php

namespace Modules\Leads\Entities\Leads\Repositories;

use Modules\Leads\Entities\Leads\Lead;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

class LeadRepository implements LeadRepositoryInterface
{
    private $columns = [
        'identification_number',
        'name',
        'last_name',
        'email',
        'telephone',
        'city_id',
        'lead_status_id',
        'lead_area_id',
        'lead_service_id',
        'lead_product_id',
        'lead_channel_id',
        'management_status_id',
        'terms_and_conditions'
    ];


    public function __construct(
        lead $lead
    ) {
        $this->model = $lead;
    }

    public function createLead(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findLeadByIdFull(int $id): Lead
    {
        try {
            return $this->model->with([
                'comments',
                'leadStatusesLogs',
                'leadPrices'
            ])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }
}
