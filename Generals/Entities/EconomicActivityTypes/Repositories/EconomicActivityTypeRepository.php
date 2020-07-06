<?php

namespace Modules\Generals\Entities\EconomicActivityTypes\Repositories;

use Modules\Generals\Entities\EconomicActivityTypes\EconomicActivityType;
use Modules\Generals\Entities\EconomicActivityTypes\Repositories\Interfaces\EconomicActivityTypeRepositoryInterface;
use Illuminate\Database\QueryException;


class EconomicActivityTypeRepository implements EconomicActivityTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'economic_activity_type'];

    public function __construct(EconomicActivityType $EconomicActivityType)
    {
        $this->model = $EconomicActivityType;
    }

    public function getAllEconomicActivityTypesNames()
    {
        try {
            return $this->model->orderBy('economic_activity_type', 'asc')
            ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
