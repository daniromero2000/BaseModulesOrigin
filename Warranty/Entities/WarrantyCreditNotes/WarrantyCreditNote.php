<?php

namespace Modules\Warranty\Entities\WarrantyCreditNotes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Warranty\Entities\WarrantyCases\WarrantyCase;
use Modules\Warranty\Entities\WarrantyCreditNoteComments\WarrantyCreditNoteComment;

class WarrantyCreditNote extends Model
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
        return $this->hasMany(WarrantyCreditNoteComment::class);
    }

}
