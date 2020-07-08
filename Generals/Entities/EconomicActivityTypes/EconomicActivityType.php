<?php

namespace Modules\Generals\Entities\EconomicActivityTypes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;

class EconomicActivityType extends Model
{
    use SoftDeletes;
    protected $table = 'economic_activity_types';

    protected $fillable = [
        'economic_activity_type',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
        'status'
    ];

    protected $hidden = [
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class)
            ->select(['economicActivityType', 'professionsList', 'city']);
    }
}
