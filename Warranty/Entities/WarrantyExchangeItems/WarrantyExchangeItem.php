<?php

namespace Modules\Warranty\Entities\WarrantyExchangeItems;

use Modules\Warranty\Entities\WarrantyChanges\WarrantyChange;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyExchangeItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_change_id',
        'product_reference',
        'product_serial',
        'product_sale_lote',
        'product_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function warrantyChange()
    {
        return $this->belongsTo(WarrantyChange::class);
    }

}
