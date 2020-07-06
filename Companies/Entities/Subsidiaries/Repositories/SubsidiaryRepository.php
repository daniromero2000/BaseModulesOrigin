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

    public function listSubsidiaries(int $totalView)
    {
        try {
            return  $this->model->with('city:id,dane,city,province_id,is_active')
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

    public function searchSubsidiary(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->get($this->columns);
            }
            return $this->model->searchSubsidiary($text)->get($this->columns);
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
