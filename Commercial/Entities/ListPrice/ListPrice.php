<?php

namespace Modules\Commercial\Entities;

use Illuminate\Database\Eloquent\Model;

class ListPrice extends Model
{
    protected $fillable = [
        'list_code',
        'name',
        'tipo',
        'status',
    ];
}
