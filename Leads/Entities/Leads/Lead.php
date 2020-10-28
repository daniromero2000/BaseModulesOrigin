<?php

namespace Modules\Leads\Entities\Leads;

// use Modules\Leads\Entities\Comments\Comment;
use Modules\Leads\Entities\LeadAreas\LeadArea;
use Modules\Leads\Entities\LeadProducts\LeadProduct;
use Modules\Leads\Entities\LeadStatuses\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Companies\Entities\Subsidiaries\Subsidiary;
use Modules\Generals\Entities\ManagementStatuses\ManagementStatus;
use Modules\Leads\Entities\LeadServices\LeadService;
use Nicolaslopezj\Searchable\SearchableTrait;

class Lead extends Model
{
    use SearchableTrait;
    use SoftDeletes;

    protected $table = 'leads';

    protected $fillable = [
        'name',
        'lastName',
        'email',
        'telephone',
        'city',
        'typeService',
        'typeProduct',
        'state',
        'channel',
        'termsAndConditions',
        'typeDocument',
        'identificationNumber',
        'assessor',
        'nearbyCity',
        'assessor_id',
        'description',
        'lead_area_id',
        'expirationDateSoat',
        'subsidiary_id',
        'statusManagement'
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
            'leads.lastName'  => 10,
            'leads.telephone' => 10,
            'leads.identificationNumber' => 10,
        ],
    ];


    public function searchLeads($term)
    {
        return self::search($term);
    }

    public function searchLeadsSubsidiaries($term)
    {
        return self::search($term);
    }

    public function searchCustomLeads($term)
    {
        return self::search($term);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'idLead');
    }

    public function leadStatus()
    {
        return $this->belongsToMany(LeadStatus::class, 'lead_status', 'lead_id', 'lead_status_id')->withTimestamps();
    }

    public function managementStatus()
    {
        return $this->belongsToMany(ManagementStatus::class, 'lead_status_management', 'lead_id', 'status_management_id')->withTimestamps();
    }

    public function leadStatuses()
    {
        return $this->belongsTo(LeadStatus::class, 'state', 'id');
    }

    public function leadService()
    {
        return $this->belongsTo(LeadService::class, 'typeService');
    }

    // public function leadStatusesLogs()
    // {
    //     return $this->hasMany(LeadStatusesLog::class, 'lead_id');
    // }

    // public function statusManagementLog()
    // {
    //     return $this->hasMany(StatusManagementLog::class, 'lead_id');
    // }

    public function leadProduct()
    {
        return $this->belongsTo(LeadProduct::class, 'typeProduct');
    }

    public function LeadArea()
    {
        return $this->belongsTo(LeadArea::class);
    }

    public function subsidiary()
    {
        return $this->belongsTo(Subsidiary::class, 'subsidiary_id');
    }
}
