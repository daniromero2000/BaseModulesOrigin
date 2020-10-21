<?php

namespace Modules\Ecommerce\Entities\Attributes;

use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use SoftDeletes;
    protected $table = 'attributes';

    protected $fillable = [
        'name',
        'is_active',
        'sort_order'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'id',
        'is_active'
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

    public function values()
    {
        return $this->hasMany(AttributeValue::class)
            ->select(['id', 'value', 'description', 'attribute_id']);
    }

    public function attributeValue()
    {
        return $this->hasMany(AttributeValue::class)
            ->select(['id', 'value', 'description', 'attribute_id'])->orderBy('value');
    }
}
