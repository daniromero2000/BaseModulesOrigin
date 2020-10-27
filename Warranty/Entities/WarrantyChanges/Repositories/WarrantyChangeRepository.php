<?php

namespace Modules\Warranty\Entities\WarrantyChanges\Repositories;

use Modules\Warranty\Entities\WarrantyChanges\Repositories\Interfaces\WarrantyChangeRepositoryInterface;
use Modules\Warranty\Entities\WarrantyChanges\WarrantyChange;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyChangeRepository implements WarrantyChangeRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'state',
        'commercial_approval',
        'warranty_approval',
        'total_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyChange $warrantyChange)
    {
        $this->model = $warrantyChange;
    }

    public function createWarrantyChange(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyChange(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyChanges($totalView): Support
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
