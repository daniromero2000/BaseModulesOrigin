<?php

namespace Modules\Warranty\Entities\WarrantyTypes;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\Model;

class WarrantyType extends Model
{

    protected $fillable = [
        'type',
        'color'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    public function warrantyCases()
    {
        return $this->hasMany(WarrantyCase::class);
    }
}