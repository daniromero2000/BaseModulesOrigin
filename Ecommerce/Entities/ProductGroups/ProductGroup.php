<?php

namespace Modules\Ecommerce\Entities\ProductGroups;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGroup extends Model
{
    use SoftDeletes;
    protected $table = 'product_groups';

    protected $fillable = [];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function productGroups()
    {
        return $this->belongsToMany(ProductGroup::class);
    }
}
