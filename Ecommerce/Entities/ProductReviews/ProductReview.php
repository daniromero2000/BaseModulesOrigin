<?php

namespace Modules\Ecommerce\Entities\ProductReviews;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Customers\Entities\Customers\Customer;
use Modules\Ecommerce\Entities\Products\Product;


class ProductReview extends Model
{
    use SearchableTrait;
    protected $table = 'product_reviews';

    protected $searchable = [
        'columns' => [
            'product_reviews.id' => 10,
            'product_reviews.product_id' => 10,
            'product_reviews.customer_id' => 10,
        ],
        'groupBy' => ['product_reviews.product_id']
    ];

    protected $fillable = [
        'id',
        'name',
        'title',
        'rating',
        'comment',
        'status',
        'product_id',
        'customer_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        //'id',
    ];

    protected $guarded = [
        //'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];



    public function customerProductReview(string $shipment_id)
    {
        return self::search($shipment_id);
    }

    public function searchForReview(array $data)
    {
        return self::search($data);
    }

    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
