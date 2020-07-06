<?php

namespace Modules\Ecommerce\Entities\Checkout;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\Products\Product;

class Checkout extends Model
{
    use SoftDeletes;
    protected $table = 'checkouts';

    protected $fillable = [
        'customer_id'
    ];

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

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withPivot([
                'quantity',
                'product_name',
                'product_sku',
                'product_price',
                'product_attribute_id'
            ]);
    }
}
