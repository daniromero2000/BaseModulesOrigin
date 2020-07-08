<?php

namespace Modules\Customers\Entities\CustomerCommentaries;

use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerCommentary extends Model
{
    use SoftDeletes;
    protected $table = 'customer_commentaries';

    public $fillable = [
        'customer_id',
        'commentary',
        'user'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance',
        'id',
        'status',
        'customer_id'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status',
        'user'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class)
            ->select([
                'id', 'customer_group_id', 'name', 'last_name', 'birthday', 'scholarity_id', 'status', 'customer_status_id', 'customer_channel_id', 'city_id',
                'data_politics', 'genre_id', 'customer_channel_id', 'civil_status_id', 'scholarity_id', 'email', 'created_at'
            ]);
    }
}
