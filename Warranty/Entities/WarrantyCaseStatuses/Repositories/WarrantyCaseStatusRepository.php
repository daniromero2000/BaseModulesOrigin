<?php

namespace Modules\Warranty\Entities\WarrantyCaseStatuses\Repositories;

use Modules\Warranty\Entities\WarrantyCaseStatuses\Repositories\Interfaces\WarrantyCaseStatusRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCaseStatuses\WarrantyCaseStatus;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCaseStatusRepository implements WarrantyCaseStatusRepositoryInterface
{
    private $columns = [
        'id',
        'status',
        'color',
        'sequence',
        'editable',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCaseStatus $warrantyCaseStatus)
    {
        $this->model = $warrantyCaseStatus;
    }

    public function createWarrantyCaseStatus(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCaseStatus(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCaseStatuses($totalView): Support
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
