<?php

namespace Modules\Libranza\Entities\Covenants;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;

class Covenant extends Model
{
    use SoftDeletes, SearchableTrait;
    
    protected $table = 'covenants';

    protected $fillable = [
        'covenant',
        'type',
        'kind_of_person',
        'origin',
        'is_active',
        'company_id'
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

    protected $searchable = [
        'columns' => [
            'covenants.covenant'       => 10,
            'covenants.kind_of_person' => 15,
        ]
    ];

    public function searchCovenant($term)
    {
        return self::search($term);
    }

}
