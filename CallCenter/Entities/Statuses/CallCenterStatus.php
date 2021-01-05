<?php

namespace Modules\CallCenter\Entities\Statuses;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallCenterStatus extends Model
{
    use SoftDeletes;
    protected $table = 'call_center_statuses';

    protected $fillable = [];
}
