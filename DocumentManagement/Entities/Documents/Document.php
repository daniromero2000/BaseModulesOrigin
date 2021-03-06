<?php

namespace Modules\DocumentManagement\Entities\Documents;

use Illuminate\Database\Eloquent\SoftDeletes;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Database\Eloquent\Model;
use Modules\DocumentManagement\Entities\DocumentCategories\DocumentCategory;
use Modules\DocumentManagement\Entities\DocumentDocumentCategory\DocumentDocumentCategory;
class Document extends Model
{
    use SoftDeletes, SearchableTrait;

    protected $table = 'documents';

    protected $fillable = [
        'id',
        'name',
        'description',
        'src',
        'is_active',
        'downloads',
        'slug'
    ];

    protected $hidden = [
        'deleted_at',
        'updated_at'
    ];

    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $dates  = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'documents.name'        => 10,
            'documents.description' => 5,
        ]
    ];

    public function searchDocument($term)
    {
        return self::search($term);
    }

    public function categories()
    {
        return $this->belongsToMany(DocumentCategory::class);
    }

    public function categoryLog()
    {
        return $this->hasMany(DocumentDocumentCategory::class);
    }
}
