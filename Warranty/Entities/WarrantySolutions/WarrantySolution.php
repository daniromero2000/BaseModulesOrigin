<?php

namespace Modules\Warranty\Entities\WarrantySolutions;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarrantySolution extends Model
{

    protected $fillable = [
        'solution',
        'created_at',
        'updated_at',
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