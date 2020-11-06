<?php

namespace Modules\Courses\Entities\CourseAttendance\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Modules\Courses\Entities\CourseAttendances\CourseAttendance;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Courses\Entities\CourseAttendances\Exceptions\CreateCourseAttendanceErrorException;
use Modules\Courses\Entities\CourseAttendances\Exceptions\CourseAttendanceNotFoundException;
use Modules\Courses\Entities\CourseAttendances\Exceptions\UpdateCourseAttendanceErrorException;
use Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces\CourseAttendanceRepositoryInterface;

class CourseAttendanceRepository implements CourseAttendanceRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'course_name',
        'identification',
        'name',
        'last_name',
        'created_at'
    ];

    private $listColumns = [
        'id',
        'course_name',
        'identification',
        'name',
        'last_name',
        'created_at'
    ];

    public function __construct(CourseAttendance $CourseAttendance)
    {
        $this->model = $CourseAttendance;
    }

    public function listCourseAttendances(int $totalView)
    {
        try {
            return  $this->model->with(['student', 'course'])
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCourseAttendance(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listCourseAttendances($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCourseAttendance($text, null, true, true)
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

            return $this->model->searchCourseAttendance($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCourseAttendance(string $text = null,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchCourseAttendance($text, null, true, true)
                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchCourseAttendance($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedCourseAttendance(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCourseAttendance(array $data): CourseAttendance
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCourseAttendanceErrorException($e);
        }
    }

    public function findCourseAttendanceById(int $id): CourseAttendance
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourseAttendanceNotFoundException($e);
        }
    }

    public function findTrashedCourseAttendanceById(int $id): CourseAttendance
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourseAttendanceNotFoundException($e);
        }
    }

    public function updateCourseAttendance(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCourseAttendanceErrorException($e);
        }
    }

    public function deleteCourseAttendance(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCourseAttendance(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
