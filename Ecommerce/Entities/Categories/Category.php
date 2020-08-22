<?php

namespace Modules\Ecommerce\Entities\Categories;

use Modules\Ecommerce\Entities\Products\Product;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use NodeTrait, SoftDeletes;
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'sort_order',
        'parent_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
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
            ->with('attributes:id,quantity,price,sale_price,default,product_id')
            ->orderBy('sort_order', 'asc');
    }
    public function countProducts()
    {
        return $this->belongsToMany(Product::class)->select(DB::raw('count(*) as total'))
            ->orderBy('sort_order', 'asc')->where('is_active', 1);
    }

    public function productsOrder()
    {
        return $this->belongsToMany(Product::class)
            ->orderBy('sort_order', 'asc');
    }

    public function productsFilter($select, $totalviews)
    {
        $data = $this->belongsToMany(Product::class)->whereHas('attributes', function (Builder $query) use ($select, $totalviews) {
            $query->whereHas('attributesValues', function (Builder $query) use ($select, $totalviews) {
                $query->whereIn('value', $select);
            });
        })->skip($totalviews)->take(30)->get();

        $count = $this->belongsToMany(Product::class)->whereHas('attributes', function (Builder $query) use ($select, $totalviews) {
            $query->whereHas('attributesValues', function (Builder $query) use ($select, $totalviews) {
                $query->whereIn('value', $select);
            });
        })->select(DB::raw('count(*) as total'))->where('is_active', 1)->get();
        return [$data, $count];
    }
}