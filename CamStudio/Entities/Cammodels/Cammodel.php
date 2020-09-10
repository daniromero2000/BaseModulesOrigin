<?php

namespace Modules\CamStudio\Entities\Cammodels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\Companies\Entities\Employees\Employee;
use Nicolaslopezj\Searchable\SearchableTrait;

class Cammodel extends Model
{
    use SoftDeletes;
    use SearchableTrait;

    protected $table = 'cammodels';
    protected $fillable = [
        'employee_id',
        'manager_id',
        'fake_age',
        'nickname',
        'height',
        'weight',
        'slug',
        'breast_cup_size',
        'tattoos_piercings',
        'meta',
        'likes_dislikes',
        'about_me',
        'private_show',
        'my_rules',
        'cover',
        'cover_page',
        'image_tks',
    ];

    protected $hidden = [
        'created_at',
        'deleted_at',
        'updated_at',
        'relevance',
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    protected $searchable = [
        'columns' => [
            'cammodels.name' => 10,
            'cammodels.email' => 5,
            'cammodels.last_name' => 5,
            'employee_identities.identity_number' => 10,
            'employee_phones.phone' => 10,
            'employee_emails.email' => 5,
        ],
        'joins' => [
            'employee_identities' => ['employees.id', 'employee_identities.employee_id'],
            'employee_phones' => ['employees.id', 'employee_phones.employee_id'],
            'employee_emails' => ['employees.id', 'employee_emails.employee_id'],
        ],
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class)
            ->select([
                'id',
                'name',
                'last_name',
                'email',
                'birthday',
                'avatar',
                'subsidiary_id',
                'employee_position_id',
                'is_active',
                'last_login_at',
                'remember_token',
            ]);
    }

    public function manager()
    {
        return $this->belongsTo(Employee::class, 'manager_id')
            ->select([
                'id',
                'name',
                'last_name',
                'email',
                'birthday',
                'avatar',
                'subsidiary_id',
                'employee_position_id',
                'is_active',
                'last_login_at',
                'remember_token',
            ]);
    }

    public function categories()
    {
        return $this->belongsToMany(CammodelCategory::class);
    }

    public function images()
    {
        return $this->hasMany(CammodelImage::class)
            ->select(['id', 'cammodel_id', 'src']);
    }
}