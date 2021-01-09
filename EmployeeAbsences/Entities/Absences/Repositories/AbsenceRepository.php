<?php

namespace Modules\EmployeeAbsences\Entities\Absences\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Companies\Entities\Absences\Absence;


class AbsenceRepository implements AbsenceRepositoryInterface
{
    private $columns = ['id', 'commentary', 'constancy', 'start_date', 'finish_date', 'state'];

    public function __construct(Absence $absence)
    {
        $this->model = $absence;
    }

    public function getAllAbsenceTimes(): Collection
    {
        try {
            return $this->model->orderBy('created_at', 'asc')->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createAbsence(array $data): Absence
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findAbsenceById(int $id): Absence
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findTrashedAbsenceById(int $id): Absence
    {
        try {
            return $this->model->withTrashed()->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateAbsence(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteAbsence(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listAbsences(int $totalView): Collection
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)->take(30)->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchAbsence(string $text = null): Collection
    {
        try {
            if (empty($text)) {
                return $this->model->get();
            }
            return $this->model->searchAbsence($text)->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedAbsence(string $text = null): Collection
    {
        try {
            if (empty($text)) {
                return $this->model->onlyTrashed($text)->get();
            }
            return $this->model->onlyTrashed()->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedAbsence(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
