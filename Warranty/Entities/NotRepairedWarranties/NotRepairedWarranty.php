<?php

namespace Modules\Warranty\Entities\NotRepairedWarranties;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class NotRepairedWarranty extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_case_id',
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
}
