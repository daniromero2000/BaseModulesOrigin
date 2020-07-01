<?php

namespace Modules\Generals\Entities\ProfessionsGroups;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;

class ProfessionsGroup extends Model
{
    use SoftDeletes;
    protected $table = 'professions_groups';

    protected $fillable = [
        'ciuo',
        'professions_group'
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

    public function professionsLists()
    {
        $this->hasMany(ProfessionsList::class);
    }
}
