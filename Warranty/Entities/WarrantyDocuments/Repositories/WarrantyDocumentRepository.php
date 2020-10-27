<?php

namespace Modules\Warranty\Entities\WarrantyDocuments\Repositories;

use Modules\Warranty\Entities\WarrantyDocuments\Repositories\Interfaces\WarrantyDocumentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyDocuments\WarrantyDocument;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyDocumentRepository implements WarrantyDocumentRepositoryInterface
{
    private $columns = [
        'id',
        'name',
        'contact',
        'type',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyDocument $warrantyDocument)
    {
        $this->model = $warrantyDocument;
    }

    public function createWarrantyDocument(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyDocument(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyDocuments($totalView): Support
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
