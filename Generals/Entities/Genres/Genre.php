<?php

namespace Modules\Generals\Entities\Genres;

use Modules\Companies\Entities\Employees\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class Genre extends Model
{
    use SoftDeletes;
    protected $table = 'genres';

    protected $fillable = [
        'genre'
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

    public function employees()
    {
        $this->hasMany(Employee::class);
    }
}
