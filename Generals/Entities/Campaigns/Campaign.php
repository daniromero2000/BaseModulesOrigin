<?php

namespace App;
namespace App\Entities\Generals\Campaigns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campaign extends Model
{    
    protected $table = 'campaigns';
    use SoftDeletes;

    protected $fillable = [
        'name',
        'socialNetwork',
        'description',
        'beginDate',
        'endingDate',
        'budget',
        'usedBudget',
        'remove'        
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];

    protected $hidden = [
        'id',
        'update_at',
        'update_at',
        'deleted_at',
        'status'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];   
}


