<?php

namespace Modules\Leads\Entities\Leads;

use Laratrust\Traits\LaratrustUserTrait;
use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Departments\Department;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Generals\Entities\Cities\City;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;
use Modules\Leads\Entities\LeadChannels\LeadChannel;
use Modules\Leads\Entities\LeadComments\LeadComment;
use Modules\Leads\Entities\LeadInformations\LeadInformation;
use Modules\Leads\Entities\LeadManagementStatusLogs\LeadManagementStatusLog;
use Modules\Leads\Entities\LeadServices\LeadService;
use Modules\Leads\Entities\LeadStatusesLogs\LeadStatusesLog;
use Nicolaslopezj\Searchable\SearchableTrait;

class Lead extends Model
{
    use LaratrustUserTrait;
    use SearchableTrait;
    use SoftDeletes;

    protected $table = 'leads';

    protected $fillable = [
        'id',
        'identification_number',
        'name',
        'last_name',
        'email',
        'telephone',
        'city_id',
        'lead_status_id',
        'department_id',
        'lead_service_id',
        'lead_product_id',
        'lead_channel_id',
        'management_status_id',
        'terms_and_conditions'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at',
    ];

    protected $dates  = [
        'created_at',
        'updated_at'
    ];

    protected $searchable = [
        'columns' => [
            'leads.name'      => 10,
            'leads.last_name' => 10,
            'leads.telephone' => 10,
            'leads.email'     => 10,
            'leads.identification_number' => 10
        ],
    ];


    public function searchLead($term)
    {
        return self::search($term);
    }

    public function leadComments()
    {
        return $this->hasMany(LeadComment::class);
    }

    public function leadStatus()
    {
        return $this->belongsToMany(LeadStatus::class, 'lead_statuses_logs', 'lead_id', 'lead_statuses_id')->withTimestamps();
    }

    public function managementStatus()
    {
        return $this->belongsToMany(ManagementStatus::class)->withTimestamps();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function leadStatuses()
    {
        return $this->belongsTo(LeadStatus::class, 'lead_status_id');
    }

    public function leadChannel()
    {
        return $this->belongsTo(LeadChannel::class);
    }

    public function leadService()
    {
        return $this->belongsTo(LeadService::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leadInformation()
    {
        return $this->hasOne(LeadInformation::class);
    }

    public function leadStatusesLogs()
    {
        return $this->hasMany(LeadStatusesLog::class)->orderBy('created_at', 'desc');
    }

    public function leadManagementStatus()
    {
        return $this->hasMany(LeadManagementStatusLog::class)->orderBy('created_at', 'desc');
    }

    public function leadProduct()
    {
        return $this->belongsTo(LeadProduct::class);
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }
}
