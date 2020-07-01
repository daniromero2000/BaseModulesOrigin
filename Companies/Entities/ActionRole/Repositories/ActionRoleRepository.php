<?php

namespace Modules\Companies\Entities\Actions\Repositories;

use Modules\Companies\Entities\ActionRole\ActionRole;
use Modules\Companies\Entities\ActionRole\Repositories\Interfaces\ActionRoleRepositoryInterface;
use Illuminate\Support\Collection;

class ActionRoleRepository implements ActionRoleRepositoryInterface
{
    protected $model;
    private $columns = ['action_id', 'role_id', 'status'];

    public function __construct(ActionRole $actionRole)
    {
        $this->model = $actionRole;
    }

    public function createActionRole(array $data): ActionRole
    {
        return $this->model->create($data);
    }

    public function listActionRole(): Collection
    {
        return $this->model->all($this->columns);
    }
}
