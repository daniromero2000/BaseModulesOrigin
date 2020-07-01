<?php

namespace Modules\Pqrs\Entities\PqrCommentaries;

use Modules\Pqrs\Entities\Pqrs\pqr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PqrCommentary extends Model
{
    use SoftDeletes;
    protected $table = 'pqr_commentaries';


    public $fillable = [
        'pqr_id',
        'commentary',
        'user',
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'pqr_id',
        'id'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
        'status'
    ];

    public function pqr()
    {
        return $this->belongsTo(Pqr::class);
    }
}
