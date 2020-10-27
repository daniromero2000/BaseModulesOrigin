<?php

namespace Modules\Warranty\Entities\WarrantyCitations\Repositories;


use Modules\Warranty\Entities\WarrantyCitations\Repositories\Interfaces\WarrantyCitationRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCitations\WarrantyCitation;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCitationRepository implements WarrantyCitationRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'state',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCitation $warrantyCitation)
    {
        $this->model = $warrantyCitation;
    }

    public function createWarrantyCitation(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCitation(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCitations($totalView): Support
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
