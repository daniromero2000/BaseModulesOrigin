<?php

namespace Modules\Leads\Entities\LeadProducts;

use Modules\Leads\Entities\LeadAreas\LeadArea;
use Illuminate\Database\Eloquent\Model;

class LeadProduct extends Model
{
    protected $table = 'lead_products';

    protected $fillable = [
        'product'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function leadArea()
    {
        return $this->belongsToMany(LeadArea::class)->withTimestamps();
    }
}
