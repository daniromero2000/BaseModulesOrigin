<?php

namespace Modules\Commercial\Entities;

use Illuminate\Database\Eloquent\Model;

class Listprice_product extends Model
{
    protected $fillable = [
        'listprice_id',
        'product_id',
    ];
}
