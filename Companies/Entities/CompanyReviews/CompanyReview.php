<?php

namespace Modules\Companies\Entities\CompaniesReviews;

use Modules\Companies\Entities\Companies\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\Customers\Customer;

class CompanyReview extends Model
{
    use SoftDeletes;
    protected $table = 'company_reviews';

    protected $fillable = [
        'name',
        'title',
        'rating',
        'comment',
        'company_id',
        'customer_id',
    ];

    protected $hidden = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'deleted_at',
        'updated_at',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class)
            ->select(['id', 'name']);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class)
            ->select(['id', 'name']);
    }
}
