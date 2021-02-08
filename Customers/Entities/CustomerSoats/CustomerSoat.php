<?php

namespace Modules\Customers\Entities\CustomerSoats;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class CustomerSoat extends Authenticatable
{
    use SearchableTrait;

    protected $table = 'polizas';

    protected $connection = 'oportudata';

    protected $primaryKey = 'cedula';

    public $timestamps = false;

    protected $fillable = [
        'cedula',
        'nombre',
        'sucursal',
        'punto', 
        'poliza',
        'formulario',
        'hasta',
        'telefono',
        'celular',
        'email',
        'ciudad',
        'direccion',
        'servicio',
        'marca',
        'modelo',
        'placa',
        'tarifa',
        'clase',
        'anno',
        'cilindraje',
        'pasajeros',
        'agrupador',
        'tipo'   
    ];

    protected $hidden = [];

    protected $searchable = [
        'columns' => [
            'CLIENTE_FAB.CEDULA'   => 10,
            'CLIENTE_FAB.NOMBRES'   => 10,
            'CLIENTE_FAB.APELLIDOS'   => 10,
        ],
    ];

    public function searchCustomers($term)
    {
        return self::search($term);
    }

}
