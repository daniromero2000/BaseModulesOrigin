<?php

namespace Modules\Warranty\Entities\WarrantyManagers;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyManager extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'telphone',
        'type',
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
