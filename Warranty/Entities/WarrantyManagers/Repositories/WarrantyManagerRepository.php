<?php

namespace Modules\Warranty\Entities\WarrantyManagers\Repositories;

use Modules\Warranty\Entities\WarrantyManagers\Repositories\Interfaces\WarrantyManagerRepositoryInterface;
use Modules\Warranty\Entities\WarrantyManagers\WarrantyManager;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyManagerRepository implements WarrantyManagerRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'contact',
        'telphone',
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyManager $warrantyManager)
    {
        $this->model = $warrantyManager;
    }

    public function createWarrantyManager(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyManager(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyManagers($totalView): Support
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
