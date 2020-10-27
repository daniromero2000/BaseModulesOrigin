<?php

namespace Modules\Warranty\Entities\WarrantyAmortizationTables\Repositories;

use Modules\Warranty\Entities\WarrantyAmortizationTables\Repositories\Interfaces\WarrantyAmortizationTableRepositoryInterface;
use Modules\Warranty\Entities\WarrantyAmortizationTables\WarrantyAmortizationTable;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyAmortizationTableRepository implements WarrantyAmortizationTableRepositoryInterface
{
    private $columns = [
        'warranty_change_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyAmortizationTable $warrantyAmortizationTable)
    {
        $this->model = $warrantyAmortizationTable;
    }

    public function createWarrantyAmortizationTable(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyAmortizationTable(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyAmortizationTables($totalView): Support
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
