<?php

namespace Modules\Warranty\Entities\WarrantyDocuments;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Modules\Warranty\Entities\WarrantyTypes\WarrantyType;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyDocument extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact',
        'warranty_type_id',
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

    public function warrantyType()
    {
        return $this->belongsTo(WarrantyType::class);
    }
}