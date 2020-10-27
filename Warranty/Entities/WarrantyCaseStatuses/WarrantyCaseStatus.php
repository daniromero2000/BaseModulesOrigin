<?php

namespace Modules\Warranty\Entities\WarrantyCaseStatuses;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyCaseStatus extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status',
        'color',
        'sequence',
        'editable',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function warrantyCases()
    {
        return $this->belongsToMany(WarrantyCase::class);
    }
}
