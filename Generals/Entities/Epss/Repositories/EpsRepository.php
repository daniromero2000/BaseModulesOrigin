<?php

namespace Modules\Generals\Entities\Epss\Repositories;

use Modules\Generals\Entities\Epss\Eps;
use Modules\Generals\Entities\Epss\Repositories\Interfaces\EpsRepositoryInterface;
use Illuminate\Database\QueryException;

class EpsRepository implements EpsRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'eps'];

    public function __construct(
        Eps $Eps
    ) {
        $this->model = $Eps;
    }

    public function getAllEpsNames()
    {
        try {
            return $this->model->orderBy('eps', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
