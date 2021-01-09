<?php

namespace Modules\Courses\Entities\Courses\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;
use Modules\Courses\Entities\Courses\Course;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Modules\Courses\Entities\Courses\Exceptions\CourseNotFoundException;
use Modules\Courses\Entities\Courses\Exceptions\CreateCourseErrorException;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class CourseRepository implements CourseRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'cover',
        'img_welcome',
        'img_footer',
        'img_button',
        'slug',
        'link',
        'is_active',
        'created_at'
    ];

    private $listColumns = [
        'id',
        'name',
        'cover',
        'slug',
        'is_active',
        'created_at'
    ];

    public function __construct(Course $course)
    {
        $this->model = $course;
    }

    public function listCourses(int $totalView)
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

    public function listCoursesFront()
    {
        try {
            return  $this->model
                ->orderBy('name', 'asc')
                ->where('is_active', '1')
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCourse(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listCourses($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchCourse($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchCourse($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countCourse(string $text = null,  $from = null, $to = null)
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                $data =  $this->model->get(['id']);
                return count($data);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchCourse($text, null, true, true)
                    ->get(['id']);
                return count($data);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])
                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchCourse($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }


    public function searchTrashedCourse(string $text = null): Collection
    {
        if (empty($text)) {
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
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new CourseNotFoundException($e);
        }
    }


    public function findCourseBySlug($slug): Course
    {
        try {
            return $this->model->where('slug', $slug)->first($this->columns);
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

    public function saveCoverImage(UploadedFile $file): string
    {
        return $file->store('products', ['disk' => 'public']);
    }

    public function updateCourse(array $data): bool
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
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
