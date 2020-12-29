<?php

namespace Modules\DocumentManagement\Entities\DocumentCategories;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\DocumentManagement\Entities\Documents\Document;

class DocumentCategory extends Authenticatable
{
    use Notifiable, SoftDeletes, SearchableTrait;
    protected $table = 'document_categories';

    protected $fillable = [
       'name',
       'company_id',
       'is_active'
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
            'document_categories.name' => 10
        ]        
    ];

    public function searchDocumentCategory($term)
    {
        return self::search($term);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class)->where('is_active', 1);
    }

}
