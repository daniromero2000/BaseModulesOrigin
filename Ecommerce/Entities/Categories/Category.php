<?php

namespace Modules\Ecommerce\Entities\Categories;

use Modules\Ecommerce\Entities\Products\Product;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    use NodeTrait, SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'parent_id'
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
        return $this->belongsToMany(Product::class)->with('attributes:id,quantity,price,sale_price,default,product_id');
    }

   public function productsFilter($select)
    {
        return $this->belongsToMany(Product::class)->whereHas('attributes', function (Builder $query) use($select) {
            $query->whereHas('attributesValues', function (Builder $query) use($select){
                $query->whereIn('value', $select);
            });
        })->get();
    }
}

