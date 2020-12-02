<?php

namespace Modules\Leads\Entities\LeadProducts;

use Modules\Companies\Entities\Departments\Department;
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

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }
}
