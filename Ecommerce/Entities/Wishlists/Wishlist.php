<?php

namespace Modules\Ecommerce\Entities\Wishlists;

use Illuminate\Database\Eloquent\Model;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;

class Wishlist extends Model
{
    protected $table = 'wishlists';

    protected $fillable = [
        'product_id',
        'customer_id',
        'moved_to_cart',
        'shared',
        'time_of_moving'
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

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
