<?php

namespace Modules\Warranty\Entities\NotRepairedWarranties\Repositories;

use Modules\Warranty\Entities\NotRepairedWarranties\NotRepairedWarranty;
use Modules\Warranty\Entities\NotRepairedWarranties\Repositories\Interfaces\NotRepairedWarrantyInterface;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class NotRepairedWarrantyRepository implements NotRepairedWarrantyInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(NotRepairedWarranty $notRepairedWarranty)
    {
        $this->model = $notRepairedWarranty;
    }

    public function createNotRepairedWarranty(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateNotRepairedWarranty(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listNotRepairedWarranties($totalView): Support
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
