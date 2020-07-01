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
        'name'
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

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public function attributeValue()
    {
        return $this->hasMany(AttributeValue::class);
    }
}