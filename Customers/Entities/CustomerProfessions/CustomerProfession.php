<?php

namespace Modules\Customers\Entities\CustomerProfessions;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class CustomerProfession extends Model
{
    use SoftDeletes;
    protected $table = 'customer_professions';

    public $fillable = [
        'customer_id',
        'professions_list_id'
    ];

    protected $hidden = [
        'updated_at',
        'relevance',
        'id',
        'professions_list_id',
        'customer_id',
        'status',
        'deleted_at'
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

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function professionsList()
    {
        return $this->belongsTo(ProfessionsList::class);
    }
}
