<?php

namespace  Modules\Generals\Entities\Logs;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $guard = 'admin';

    protected $table = 'logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'data',
        'response'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

  
}
