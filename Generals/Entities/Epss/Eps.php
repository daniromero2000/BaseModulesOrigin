<?php

namespace  Modules\Generals\Entities\Epss;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerEpss\CustomerEps;

class Eps extends Model
{
    use SoftDeletes;
    protected $table = 'epss';

    protected $fillable = [
        'eps'
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

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function customersEpss()
    {
        return $this->hasMany(CustomerEps::class);
    }
}
