<?php

namespace Modules\Warranty\Entities\ItemFailures;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ItemFailure extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
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
        return $this->hasMany(WarrantyCase::class);
    }

}
