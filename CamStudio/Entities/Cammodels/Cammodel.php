<?php

namespace Modules\CamStudio\Entities\Cammodels;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Employees\Employee;

class Cammodel extends Model
{
    use SoftDeletes;

    protected $table = 'cammodels';
    protected $fillable = [
        'employee_id',
        'manager_id',
        'fake_age',
        'nickname',
        'height',
        'weight',
        'breast_cup_size',
        'tattoos_piercings',
        'meta',
        'likes_dislikes',
        'about_me',
        'private_show',
        'my_rules'
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

    protected $dates  = [
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
            ->select(['id', 'name', 'last_name', 'email', 'birthday', 'avatar', 'subsidiary_id', 'employee_position_id', 'is_active', 'last_login_at', 'remember_token']);
    }
}
