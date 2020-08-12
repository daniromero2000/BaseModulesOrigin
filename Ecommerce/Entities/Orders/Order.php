<?php

namespace Modules\Ecommerce\Entities\Orders;

use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\OrderStatuses\OrderStatus;
use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Ecommerce\Entities\OrderCommentaries\OrderCommentary;
use Modules\Ecommerce\Entities\OrderPayments\OrderPayment;
use Nicolaslopezj\Searchable\SearchableTrait;

class Order extends Model
{
    use SearchableTrait, SoftDeletes;
    protected $table = 'orders';

    protected $searchable = [
        'columns' => [
            'customers.name' => 10,
            'orders.reference' => 8,
            'orders.id' => 8,
        ],
        'joins' => [
            'customers' => ['customers.id', 'orders.customer_id'],
            'order_product' => ['orders.id', 'order_product.order_id']
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
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class)
            ->select(['id', 'name', 'description', 'url', 'is_free', 'cost', 'logo', 'is_active']);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class)
            ->select(['id', 'housing_id', 'customer_address', 'time_living', 'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment', 'default_address']);
    }

    public function orderStatus()
    {
        return $this->belongsTo(OrderStatus::class)
            ->select(['id', 'name', 'color', 'is_active']);
    }

    public function searchForOrder(string $term)
    {
        return self::search($term)->with('courier');
    }

    public function commentaries()
    {
        return $this->hasMany(OrderCommentary::class)
            ->select(['id', 'commentary', 'user', 'customer_notified', 'order_id', 'created_at']);
    }

    public function orderPayments()
    {
        return  $this->hasMany(OrderPayment::class)
            ->select(['id', 'method', 'description', 'transaction_id', 'transaction_order', 'state', 'order_id', 'created_at']);
    }
}
