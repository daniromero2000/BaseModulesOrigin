<?php

namespace Modules\Customers\Entities\NewsletterSubscriptions;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsletterSubscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'email',
        'is_active'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
        'relevance'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];
}
