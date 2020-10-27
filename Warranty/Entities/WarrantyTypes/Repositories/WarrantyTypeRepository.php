<?php

namespace Modules\Warranty\Entities\WarrantyTypes\Repositories;

use Modules\Warranty\Entities\WarrantyTypes\Repositories\Interfaces\WarrantyTypeRepositoryInterface;
use Modules\Warranty\Entities\WarrantyTypes\WarrantyType;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyTypeRepository implements WarrantyTypeRepositoryInterface
{
    private $columns = [
        'id',
        'type',
        'color',
        'created_at',
        'updated_at',
    ];

    public function __construct(WarrantyType $WarrantyType)
    {
        $this->model = $WarrantyType;
    }

    public function createWarrantyType(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyType(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyTypes($totalView): Support
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