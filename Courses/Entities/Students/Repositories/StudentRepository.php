<?php

namespace Modules\Courses\Entities\Students\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Modules\Courses\Entities\Students\Student;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Courses\Entities\Students\Exceptions\CreateStudentErrorException;
use Modules\Courses\Entities\Students\Exceptions\StudentNotFoundException;
use Modules\Courses\Entities\Students\Exceptions\UpdateStudentErrorException;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'id_type',
        'identification',
        'name',
        'last_name',
        'position',
        'email',
        'phone',
        'hotel_name',
        'hotel_city',
        'start_date',
        'end_date',
        'is_active',
    ];

    private $listColumns = [
        'id',
        'id_type',
        'identification',
        'name',
        'last_name',
        'position',
        'email',
        'phone',
        'hotel_name',
        'hotel_city',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function __construct(Student $student)
    {
        $this->model = $student;
    }

    public function listStudents(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('id', 'asc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchStudent(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listStudents($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchStudent($text, null, true, true)
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

            return $this->model->searchStudent($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countStudents(string $text = null,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchStudent($text, null, true, true)
                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchStudent($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function searchTrashedStudent(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createStudent(array $data): Student
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateStudentErrorException($e);
        }
    }

    public function findStudentById(int $id): Student
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StudentNotFoundException($e);
        }
    }

    public function findStudentByIdentification(int $id)
    {
        try {
            return $this->model->with('courses')->where('identification', $id)->get($this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StudentNotFoundException($e);
        }
    }

    public function findTrashedStudentById(int $id): Student
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StudentNotFoundException($e);
        }
    }

    public function updateStudent(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateStudentErrorException($e);
        }
    }

    public function deleteStudent(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedStudent(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
