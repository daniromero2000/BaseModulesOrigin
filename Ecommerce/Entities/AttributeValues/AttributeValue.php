<?php

namespace Modules\Ecommerce\Entities\AttributeValues;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use SoftDeletes;
    protected $table = 'attribute_values';

    protected $fillable = [
        'value'
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

    public function attribute()
    {
        return $this->belongsTo(Attribute::class);
    }

    public function productAttributes()
    {
        return $this->belongsToMany(ProductAttribute::class);
    }
}
