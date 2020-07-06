<?php

namespace Modules\Generals\Entities\Relationships;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;
use Modules\Generals\Entities\ReferenceTypes\ReferenceType;

class Relationship extends Model
{
    use SoftDeletes;
    protected $table = 'relationships';

    protected $fillable = [
        'relationship'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customerReferences()
    {
        $this->hasMany(CustomerReference::class);
    }

    public function referenceType()
    {
        return $this->belongsTo(ReferenceType::class);
    }
}
