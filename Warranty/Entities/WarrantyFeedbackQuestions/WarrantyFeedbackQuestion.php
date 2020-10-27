<?php

namespace Modules\Warranty\Entities\WarrantyFeedbackQuestions;

use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyFeedbackQuestion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'question',
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
