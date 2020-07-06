<?php

namespace Modules\Generals\Entities\Stratums\Repositories;

use Modules\Generals\Entities\Stratums\Stratum;
use Modules\Generals\Entities\Stratums\Repositories\Interfaces\StratumRepositoryInterface;
use Illuminate\Database\QueryException;

class StratumRepository implements StratumRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(
        Stratum $Stratum
    ) {
        $this->model = $Stratum;
    }

    public function getAllStratumsNames()
    {
        try {
            return $this->model->orderBy('stratum', 'asc')
                ->get(['id', 'stratum']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
