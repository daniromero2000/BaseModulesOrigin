<?php

namespace Modules\Warranty\Entities\WarrantyCitationComments;

use Modules\Warranty\Entities\WarrantyCitations\WarrantyCitation;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyCitationComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_citation_id',
        'comment',
        'employee_id'.
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function citation()
    {
        return $this->belongsTo(WarrantyCitation::class);
    }
}
