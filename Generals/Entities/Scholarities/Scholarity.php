<?php

namespace Modules\Generals\Entities\Scholarities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class Scholarity extends Model
{
    use SoftDeletes;
    protected $table = 'scholarities';

    protected $fillable = [
        'scholarity'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customers()
    {
        $this->hasMany(Customer::class);
    }
}
