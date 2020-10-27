<?php

namespace Modules\Warranty\Entities\ItemFailures\Repositories;

use Modules\Warranty\Entities\ItemFailures\Repositories\Interfaces\ItemFailureRepositoryInterface;
use Modules\Warranty\Entities\ItemFailures\ItemFailure;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class ItemFailureRepository implements ItemFailureRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'contact',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(ItemFailure $itemFailure)
    {
        $this->model = $itemFailure;
    }

    public function createItemFailure(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateItemFailure(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listItemFailures($totalView): Support
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
