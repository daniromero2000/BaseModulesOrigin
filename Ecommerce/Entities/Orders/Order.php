<?php

namespace Modules\Ecommerce\Entities\Orders;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'orders';

    protected $searchable = [
        'columns' => [
            'customers.name' => 10,
            'orders.reference' => 8,
            'products.name' => 5
        ],
        'joins' => [
            'customers' => ['customers.id', 'orders.customer_id'],
            'order_product' => ['orders.id', 'order_product.order_id'],
            'products' => ['products.id', 'order_product.product_id'],
        ],
        'groupBy' => ['orders.id']
    ];

    protected $fillable = [
        'reference',
        'courier_id', // @deprecated
        'courier',
        'customer_id',
        'address_id',
        'order_status_id',
        'payment',
        'discounts',
        'sub_total',
        'grand_total',
        'tax_amount',
        'total_paid',
        'invoice',
        'label_url',
        'tracking_number',
        'total_shipping'
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
                'product_description',
                'product_price',
                'product_attribute_id'
            ]);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function searchForOrder(string $term)
    {
        return self::search($term);
    }
}
