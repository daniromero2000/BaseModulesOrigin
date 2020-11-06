<?php

namespace Modules\Companies\Entities\Subsidiaries\Repositories;

use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Companies\Entities\Subsidiaries\Repositories\Interfaces\SubsidiaryRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class SubsidiaryRepository implements SubsidiaryRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'address', 'phone', 'opening_hours', 'city_id'];

    public function __construct(Subsidiary $subsidiary)
    {
        $this->model = $subsidiary;
    }

    public function getAllSubsidiaryNames(): Collection
    {
        try {
            return $this->model->orderBy('name', 'desc')->get(['id', 'name']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getSubsidiaryForCompany($company): Collection
    {
        try {
            return $this->model->where('company_id', $company)
                ->orderBy('name', 'desc')
                ->get(['id', 'name']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listSubsidiaries(int $totalView, $company)
    {
        try {
            return  $this->model->with('city:id,dane,city,province_id,is_active')
                ->where('company_id', $company)
                ->orderBy('name', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (\Throwable $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createSubsidiary(array $params): Subsidiary
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateSubsidiary(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findSubsidiaryById(int $id): Subsidiary
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findTrashedSubsidiaryById(int $id): Subsidiary
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteSubsidiary(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchSubsidiary(string $text = null, int $totalView, $company, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listSubsidiaries($totalView, $company);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchSubsidiary($text, null, true, true)
                    ->where('company_id', $company)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->where('company_id', $company)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchSubsidiary($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->where('company_id', $company)
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countSubsidiaries(string $text = null, $company,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model
                    ->where('company_id', $company)
                    ->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchSubsidiary($text, null, true, true)
                    ->where('company_id', $company)
                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->where('company_id', $company)
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchSubsidiary($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->where('company_id', $company)
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedSubsidiary(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->onlyTrashed()->get($this->columns);
            }
            return $this->model->onlyTrashed()->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedSubsidiary(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
