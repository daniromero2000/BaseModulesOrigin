<?php

namespace Modules\Warranty\Entities\WarrantyCases\Repositories;

use Modules\Warranty\Entities\WarrantyCases\Repositories\Interfaces\WarrantyCaseRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCaseRepository implements WarrantyCaseRepositoryInterface
{
    private $columns = [
        'id',
        'customer_id',
        'employee_id',
        'invoice',
        'invoice_total',
        'product_reference',
        'product_serial',
        'product_name',
        'product_price',
        'product_date_purchase',
        'product_sale_lote',
        'type_purchase',
        'subsidiary_id',
        'item_failure_id',
        'failure_description',
        'product_state',
        'product_accesories',
        'product_ubication',
        'warranty_manager_id',
        'type',
        'reason_deneid',
        'type_solution',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCase $warrantyCase)
    {
        $this->model = $warrantyCase;
    }

    public function createWarrantyCase(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCase(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCases($totalView): Support
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
