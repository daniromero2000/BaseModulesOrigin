<?php

namespace Modules\Ecommerce\Entities\Checkout;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;
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

    public function customer()
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
