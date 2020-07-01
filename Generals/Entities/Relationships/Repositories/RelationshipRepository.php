<?php

namespace Modules\Generals\Entities\Relationships\Repositories;

use Modules\Generals\Entities\Relationships\Relationship;
use Modules\Generals\Entities\Relationships\Repositories\Interfaces\RelationshipRepositoryInterface;
use Illuminate\Database\QueryException;

class RelationshipRepository implements RelationshipRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'relationship'];

    public function __construct(
        Relationship $Relationship
    ) {
        $this->model = $Relationship;
    }

    public function getAllRelationshipsNames()
    {
        try {
            return $this->model->orderBy('relationship', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
