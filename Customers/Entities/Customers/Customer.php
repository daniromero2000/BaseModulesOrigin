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
use Modules\Ecommerce\Entities\Wishlists\Wishlist;
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
        'updated_at',
        'birthday'
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
        return $this->hasMany(CustomerAddress::class)->whereDefaultAddress(true)
            ->with(['housing', 'stratum', 'city'])
            ->select(['id', 'housing_id', 'customer_address', 'time_living', 'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment', 'default_address']);
    }

    public function customerAddressesforShipment()
    {
        return $this->hasMany(CustomerAddress::class)->whereDefaultAddress(true)
            ->with(['city'])
            ->select(['id', 'customer_address', 'city_id', 'customer_id', 'default_address']);
    }

    public function frontCustomerAddresses()
    {
        return $this->hasMany(CustomerAddress::class)->whereDefaultAddress(true)
            ->with(['city'])
            ->select(['id', 'housing_id', 'customer_address', 'time_living', 'stratum_id', 'city_id', 'customer_id', 'postal_code', 'comment', 'default_address']);
    }

    public function customerProfessions()
    {
        return $this->hasMany(CustomerProfession::class)
            ->whereStatus(true)
            ->with(['professionsList'])
            ->select(['id', 'professions_list_id', 'customer_id', 'status', 'created_at']);
    }

    public function customerIdentities()
    {
        return $this->hasMany(CustomerIdentity::class)
            ->whereStatus(true)
            ->with(['identityType', 'city'])
            ->select(['id', 'identity_type_id', 'identity_number', 'expedition_date', 'city_id', 'customer_id', 'status', 'created_at']);
    }

    public function customerPhones()
    {
        return $this->hasMany(CustomerPhone::class)
            ->whereDefaultPhone(true)
            ->select(['id', 'phone_type', 'phone', 'customer_id', 'default_phone', 'phone_verified_at', 'created_at']);
    }

    public function customerEpss()
    {
        return $this->hasMany(CustomerEps::class)
            ->whereDefaultEps(true)
            ->with('eps')
            ->select(['id', 'eps_id', 'customer_id', 'default_eps', 'created_at']);
    }

    public function customerReferences()
    {
        return $this->hasMany(CustomerReference::class)
            ->whereIsActive(true)
            ->with(['customerPhone', 'relationship'])
            ->select(['id', 'customer_id', 'customer_phone_id', 'relationship_id', 'is_active', 'created_at']);
    }

    public function customerEconomicActivities()
    {
        return $this->hasMany(CustomerEconomicActivity::class)
            ->whereIsActive(true)
            ->with(['economicActivityType', 'professionsList', 'city']);
    }

    public function customerEmails()
    {
        return $this->hasMany(CustomerEmail::class)
            ->whereDefaultEmail(true)
            ->select(['id', 'email', 'customer_id', 'default_email', 'email_verified_at', 'created_at']);
    }

    public function customerCommentaries()
    {
        return $this->hasMany(CustomerCommentary::class)
            ->with(['customer'])
            ->select(['id', 'commentary', 'user', 'customer_id', 'created_at']);
    }

    public function customerVehicles()
    {
        return $this->hasMany(CustomerVehicle::class)
            ->whereStatus(true)
            ->with(['vehicleBrand', 'vehicleType'])
            ->select(['id', 'vehicle_type_id', 'vehicle_brand_id', 'customer_id', 'status', 'created_at']);
    }

    public function customerStatus()
    {
        return $this->belongsTo(CustomerStatus::class)
            ->select(['id', 'name', 'color', 'is_active']);
    }

    public function customerStatusesLog()
    {
        return $this->hasMany(CustomerStatusesLog::class)
            ->with(['employee'])
            ->select(['id', 'customer_id', 'status', 'employee_id', 'time_passed', 'created_at']);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class)
            ->select(['id', 'genre']);
    }

    public function customerChannel()
    {
        return $this->belongsTo(CustomerChannel::class)
            ->select(['id', 'channel', 'is_active']);
    }

    public function civilStatus()
    {
        return $this->belongsTo(CivilStatus::class)
            ->select(['id', 'civil_status']);
    }

    public function scholarity()
    {
        return $this->belongsTo(Scholarity::class)
            ->select(['id', 'scholarity']);
    }

    public function city()
    {
        return $this->belongsTo(City::class)
            ->select(['id', 'dane', 'city', 'province_id', 'is_active']);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)
            ->select(['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'sub_total', 'tax_amount', 'grand_total', 'created_at']);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class)->where('moved_to_cart', null);
    }
}
