<?php

namespace Modules\Warranty\Entities\WarrantySolutions\Repositories;

use Modules\Warranty\Entities\WarrantySolutions\Repositories\Interfaces\WarrantySolutionRepositoryInterface;
use Modules\Warranty\Entities\WarrantySolutions\WarrantySolution;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantySolutionRepository implements WarrantySolutionRepositoryInterface
{
    private $columns = [
        'solution',
        'created_at',
        'updated_at',
    ];

    public function __construct(WarrantySolution $WarrantySolution)
    {
        $this->model = $WarrantySolution;
    }

    public function createWarrantySolution(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantySolution(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantySolutions($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}