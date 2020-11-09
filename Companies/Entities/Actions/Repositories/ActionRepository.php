<?php

namespace Modules\Companies\Entities\Actions\Repositories;

use Modules\Companies\Entities\Actions\Action;
use Modules\Companies\Entities\Actions\Repositories\Interfaces\ActionRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Actions\Exceptions\UpdateActionErrorException;
use Modules\Companies\Entities\Actions\Exceptions\ActionNotFoundException;
use Modules\Companies\Entities\Actions\Exceptions\CreateActionErrorException;

class ActionRepository implements ActionRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'permission_id',
        'name',
        'icon',
        'route',
        'principal',
        'status'
    ];

    public function __construct(Action $action)
    {
        $this->model = $action;
    }

    public function createAction(array $data): Action
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateActionErrorException($e);
        }
    }

    public function findActionById(int $id): Action
    {
        try {
            return $this->model->with('role:id,name')->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ActionNotFoundException($e);
        }
    }

    public function updateAction(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateActionErrorException($e);
        }
    }

    public function deleteAction(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listActions(int $totalView): Collection
    {
        try {
            return $this->model->orderBy('permission_id', 'asc')
                ->skip($totalView)->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchAction(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listActions($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchAction($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchAction($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countAction(string $text = null,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchAction($text, null, true, true)
                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchAction($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function searchTrashedAction(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }
        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function findTrashedActionById(int $id): Action
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new ActionNotFoundException($e);
        }
    }

    public function recoverTrashedAction(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
