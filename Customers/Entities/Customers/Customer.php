<?php

namespace Modules\Customers\Entities\Customers;

use Modules\Generals\Entities\Cities\City;
use Modules\Customers\Entities\CustomerAddresses\CustomerAddress;
use Modules\Customers\Entities\CustomerPhones\CustomerPhone;
use Modules\Customers\Entities\CustomerEmails\CustomerEmail;
use Modules\Customers\Entities\CustomerCommentaries\CustomerCommentary;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Modules\Customers\Entities\CustomerChannels\CustomerChannel;
use Modules\Generals\Entities\CivilStatuses\CivilStatus;
use Modules\Generals\Entities\Genres\Genre;
use Modules\Generals\Entities\Scholarities\Scholarity;
use Modules\Customers\Entities\CustomerEconomicActivities\CustomerEconomicActivity;
use Modules\Customers\Entities\CustomerEpss\CustomerEps;
use Modules\Customers\Entities\CustomerIdentities\CustomerIdentity;
use Modules\Customers\Entities\CustomerStatuses\CustomerStatus;
use Modules\Customers\Entities\CustomerStatusesLogs\CustomerStatusesLog;
use Modules\Customers\Entities\CustomerVehicles\CustomerVehicle;
use Modules\Customers\Entities\CustomerProfessions\CustomerProfession;
use Modules\Customers\Entities\CustomerReferences\CustomerReference;
use Modules\Ecommerce\Entities\Orders\Order;
use Nicolaslopezj\Searchable\SearchableTrait;

class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes, SearchableTrait;
    protected $table = 'customers';

    protected $fillable = [
        'name',
        'last_name',
        'birthday',
        'scholarity_id',
        'password',
        'status',
        'customer_status_id',
        'customer_channel_id',
        'city_id',
        'data_politics',
        'genre_id',
        'customer_channel_id',
        'civil_status_id',
        'scholarity_id',
        'channel_id',
        'email'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'deleted_at',
        'updated_at',
        'relevance',
        'genre'
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
            'customers.name'                      => 10,
            'customers.last_name'                 => 5,
            'customer_identities.identity_number' => 10,
            'customer_phones.phone'               => 10,
            'customer_emails.email'               => 5,
        ],
        'joins' => [
            'customer_identities' => ['customers.id', 'customer_identities.customer_id'],
            'customer_phones'     => ['customers.id', 'customer_phones.customer_id'],
            'customer_emails'     => ['customers.id', 'customer_emails.customer_id'],
        ],
    ];

    public function searchCustomer($term)
    {
        return self::search($term);
    }

    public function customerAddresses()
    {
        return $this->hasMany(CustomerAddress::class)->whereDefaultAddress(true)->with(['housing', 'stratum', 'city']);
    }

    public function customerProfessions()
    {
        return $this->hasMany(CustomerProfession::class)->whereStatus(true)->with(['professionsList']);
    }

    public function customerIdentities()
    {
        return $this->hasMany(CustomerIdentity::class)->whereStatus(true)->with(['identityType', 'city']);
    }

    public function customerPhones()
    {
        return $this->hasMany(CustomerPhone::class)->whereDefaultPhone(true);
    }

    public function customerEpss()
    {
        return $this->hasMany(CustomerEps::class)->whereDefaultEps(true)->with('eps');
    }

    public function customerReferences()
    {
        return $this->hasMany(CustomerReference::class)->whereIsActive(true)->with(['customerPhone', 'relationship']);
    }

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class)->whereIsActive(true)->with(['economicActivityType', 'professionsList', 'city']);
    }

    public function customerEmails()
    {
        return $this->hasMany(CustomerEmail::class)->whereDefaultEmail(true);
    }

    public function customerCommentaries()
    {
        return $this->hasMany(CustomerCommentary::class)->with(['customer']);
    }

    public function customerVehicles()
    {
        return $this->hasMany(CustomerVehicle::class)->whereStatus(true)->with(['vehicleBrand', 'vehicleType']);
    }

    public function customerStatus()
    {
        return $this->belongsTo(CustomerStatus::class);
    }

    public function customerStatusesLog()
    {
        return $this->hasMany(CustomerStatusesLog::class)->with(['employee']);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function customerChannel()
    {
        return $this->belongsTo(CustomerChannel::class);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function scholarity()
    {
        return $this->belongsTo(Scholarity::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
