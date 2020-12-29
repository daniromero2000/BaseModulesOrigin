<?php

namespace Modules\Libranza\Entities\Covenants\Repositories;

use Modules\Libranza\Entities\Covenants\Covenant;
use Modules\Libranza\Entities\Covenants\Repositories\Interfaces\CovenantRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection as Support;

class CovenantRepository implements CovenantRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'covenant',
        'type',
        'kind_of_person',
        'origin',
        'is_active'
    ];

    public function __construct(
        Covenant $Covenant
    ) {
        $this->model = $Covenant;
    }

    public function getAllCovenantsNames()
    {
        try {
            return $this->model->where('is_active', 1)
                ->orderBy('covenant', 'asc')
                ->get(['id', 'covenant']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCovenants($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createCovenant(array $params): Covenant
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            // throw new CreateCovenantErrorException($e);
        }
    }

    public function searchCovenant(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCovenants($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCovenant($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchCovenant($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCovenants(string $text = null,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model
                    ->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchCovenant($text, null, true, true)

                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])

                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchCovenant($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])

                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCovenant(array $params)
    {
        try {
            $data = $this->findCovenantById($params['id']);
            return $data->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCovenantById(int $id): Covenant
    {
        try {
            $data = $this->model->findOrFail($id, $this->columns);

            return $data;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteCovenant($id): bool
    {
        try {
            $data = $this->findCovenantById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
