<?php

namespace Modules\Courses\Entities\Courses\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Courses\Entities\Courses\Course;
use Modules\Courses\Entities\Courses\Exceptions\CreateCourseErrorException;
use Modules\Courses\Entities\Courses\Exceptions\CourseNotFoundException;
use Modules\Courses\Entities\Courses\Exceptions\UpdateCourseErrorException;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    protected $model;
    private $columns = [

    ];

    private $listColumns = [

    ];

    private $courseColumns = [

    ];

    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    public function listCourses(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('name', 'desc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCourse(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchCourse($text)->get($this->columns);
    }

    public function searchTrashedCourse(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createCourse(array $data): Course
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCourseErrorException($e);
        }
    }

    public function findCourseById(int $id): Course
    {
        try {
            return $this->model->findOrFail($id, $this->courseColumns);
        } catch (ModelNotFoundException $e) {
            throw new CourseNotFoundException($e);
        }
    }

    public function findTrashedCourseById(int $id): Course
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourseNotFoundException($e);
        }
    }

    public function updateCourse(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new UpdateCourseErrorException($e);
        }
    }

    public function deleteCourse(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedCourse(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
