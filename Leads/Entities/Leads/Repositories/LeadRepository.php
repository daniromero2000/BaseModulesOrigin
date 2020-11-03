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
        'id',
        'identification_number',
        'name',
        'last_name',
        'email',
        'telephone',
        'city_id',
        'lead_status_id',
        'department_id',
        'lead_service_id',
        'lead_product_id',
        'lead_channel_id',
        'management_status_id',
        'terms_and_conditions',
        'created_at'
    ];

    private $columnsList = [
        'id',
        'identification_number',
        'name',
        'last_name',
        'email',
        'telephone',
        'lead_status_id',
        'department_id',
        'created_at'
    ];


    public function __construct(
        lead $lead
    ) {
        $this->model = $lead;
    }

    public function listLeads(int $totalView, $deparment)
    {
        try {
            return $this->model->whereIn('department_id', $deparment)
                ->orderBy('created_at', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createLead(array $data): Lead
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function updateLead($id, array $data)
    {
        try {
            return $this->model->update(['id', $id], $data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findLeadByIdFull(int $id): Lead
    {
        try {
            return $this->model->with([])
                ->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchLeads(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                foreach (auth()->guard('employee')->user()->department as $key => $value) {
                    $userDepartmet[$key] = $value->id;
                }
                return $this->listLeads($totalView, $userDepartmet);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchLeads($text, null, true, true)
                    ->skip($totalView)
                    ->take(50)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(50)
                    ->get($this->columns);
            }
            dd($this->model->searchLeads($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns));
            return $this->model->searchLeads($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedLead(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }
}
