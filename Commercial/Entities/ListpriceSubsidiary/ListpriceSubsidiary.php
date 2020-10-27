<?php

namespace Modules\Commercial\Entities;

use Illuminate\Database\Eloquent\Model;

class Listprice_subsidiary extends Model
{
    protected $fillable = [
       'id_listprice',
       'id_subsidiary',
       'price',
       'tax',
       'deviation_high',
       'deviation_less',
       'since',
       'until',       
    ];
}
