<?php

namespace Modules\Warranty\Entities\WarrantyCreditNoteComments;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Warranty\Entities\WarrantyCreditNotes\WarrantyCreditNote;

class WarrantyCreditNoteComment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'warranty_credit_note_id',
        'comment',
        'employee_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function creditNote()
    {
        return $this->belongsTo(WarrantyCreditNote::class);
    }
}
