<?php

namespace Modules\Generals\Entities\IdentityTypes\Repositories;

use Modules\Generals\Entities\IdentityTypes\IdentityType;
use Modules\Generals\Entities\IdentityTypes\Repositories\Interfaces\IdentityTypeRepositoryInterface;
use Illuminate\Database\QueryException;

class IdentityTypeRepository implements IdentityTypeRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'identity_type'];

    public function __construct(
        IdentityType $IdentityType
    ) {
        $this->model = $IdentityType;
    }

    public function getAllIdentityTypesNames()
    {
        try {
            return $this->model->orderBy('identity_type', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
