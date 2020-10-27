<?php

namespace Modules\Warranty\Entities\WarrantyAmortizationTables;

use Modules\Warranty\Entities\WarrantyChanges\WarrantyChange;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyAmortizationTable extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_change_id',
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
