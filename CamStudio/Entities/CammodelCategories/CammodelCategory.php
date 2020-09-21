<?php

namespace Modules\CamStudio\Entities\CammodelCategories;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CammodelCategory extends Model
{
    use NodeTrait, SoftDeletes;
    protected $table = 'cammodel_categories';

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
        'sort_order',
        'parent_id'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at',
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'cammodel_categories.name' => 10,
            'cammodel_categories.slug' => 5
        ],
    ];

    public function searchCammodelCategories(string $term): Collection
    {
        return self::search($term)->get();
    }

    public function cammodel()
    {
        return $this->belongsToMany(Cammodel::class)
            ->orderBy('sort_order', 'asc');
    }

    public function cammodelOrder()
    {
        return $this->belongsToMany(Cammodel::class)
            ->orderBy('sort_order', 'asc');
    }
}