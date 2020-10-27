<?php

namespace Modules\Warranty\Entities\WarrantyCitations;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Modules\Warranty\Entities\WarrantyCitationComments\WarrantyCitationComment;

class WarrantyCitation extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_case_id',
        'state',
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

    public function comments()
    {
        return $this->hasMany(WarrantyCitationComment::class);
    }
}
