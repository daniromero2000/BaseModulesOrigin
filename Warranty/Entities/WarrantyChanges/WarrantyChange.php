<?php

namespace Modules\Warranty\Entities\WarrantyChanges;

use Modules\Warranty\Entities\WarrantyAmortizationTables\WarrantyAmortizationTable;
use Modules\Warranty\Entities\WarrantyExchangeItems\WarrantyExchangeItem;
use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyChange extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_case_id',
        'state',
        'commercial_approval',
        'warranty_approval',
        'total_price',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function warrantyCase()
    {
        return $this->belongsTo(WarrantyCase::class);
    }

    public function items()
    {
        return $this->hasMany(WarrantyExchangeItem::class);
    }

    public function amotizationTables()
    {
        return $this->hasMany(WarrantyAmortizationTable::class);
    }
}
