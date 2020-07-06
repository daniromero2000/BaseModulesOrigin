<?php

namespace Modules\Generals\Entities\ProfessionsLists;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Customers\Entities\CustomerProfessions\CustomerProfession;
use Modules\Generals\Entities\ProfessionsGroups\ProfessionsGroup;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;

class ProfessionsList extends Model
{
    use SoftDeletes;
    protected $table = 'professions_lists';

    public $fillable = [
        'ciuo',
        'profession',
    ];

    protected $hidden = [];

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

    public function professionGroup()
    {
        return $this->belongsTo(ProfessionsGroup::class);
    }

    public function customerProfessions()
    {
        return $this->hasMany(CustomerProfession::class);
    }

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class);
    }
}
