<?php

namespace Modules\Warranty\Entities\NotRepairedWarrantyComments;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class NotRepairedWarrantyComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'not_repaired_warranty_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
