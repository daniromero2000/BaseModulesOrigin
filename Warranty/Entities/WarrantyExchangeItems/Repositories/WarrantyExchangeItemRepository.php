<?php

namespace Modules\Warranty\Entities\WarrantyExchangeItems\Repositories;

use Modules\Warranty\Entities\WarrantyExchangeItems\Repositories\Interfaces\WarrantyExchangeItemRepositoryInterface;
use Modules\Warranty\Entities\WarrantyExchangeItems\WarrantyExchangeItem;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyExchangeItemRepository implements WarrantyExchangeItemRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'product_reference',
        'product_serial',
        'product_sale_lote',
        'product_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyExchangeItem $warrantyExchangeItem)
    {
        $this->model = $warrantyExchangeItem;
    }

    public function createWarrantyExchangeItem(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyExchangeItem(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyExchangeItems($totalView): Support
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
