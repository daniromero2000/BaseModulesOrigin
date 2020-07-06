<?php

namespace Modules\Ecommerce\Entities\ProductImages;

use Modules\Ecommerce\Entities\Products\Product;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id',
        'src'
    ];

    protected $hidden = [
        'id',
    ];

    protected $guarded = [
        'id',
    ];

    protected $dates  = [
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
