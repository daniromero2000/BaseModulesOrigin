<?php

namespace Modules\Generals\Entities\ProfessionsLists\Repositories;

use Modules\Generals\Entities\ProfessionsLists\ProfessionsList;
use Modules\Generals\Entities\ProfessionsLists\Exceptions\CreateProfessionsListErrorException;
use Modules\Generals\Entities\ProfessionsLists\Repositories\Interfaces\ProfessionsListRepositoryInterface;
use Modules\Customers\Entities\Customers\Customer;
use Illuminate\Database\QueryException;

class ProfessionsListRepository implements ProfessionsListRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(ProfessionsList $ProfessionsList)
    {
        $this->model = $ProfessionsList;
    }

    public function getAllProfessionsNames()
    {
        try {
            return $this->model->orderBy('profession', 'asc')
                ->get(['id', 'profession']);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
