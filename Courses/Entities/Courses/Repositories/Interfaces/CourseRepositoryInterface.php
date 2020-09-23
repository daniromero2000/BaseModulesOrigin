<?php

namespace Modules\Courses\Entities\Courses\Repositories\Interfaces;

use Modules\Courses\Entities\Courses\Course;
use Illuminate\Support\Collection;

interface CourseRepositoryInterface
{
    public function listCourses(int $totalView);

    public function createCourse(array $params): Course;

    public function findCourseById(int $id): Course;

    public function findTrashedCourseById(int $id): Course;

    public function updateCourse(array $params): bool;

    public function searchCourse(string $text = null): Collection;

    public function searchTrashedCourse(string $text = null): Collection;

    public function deleteCourse(): bool;

    public function recoverTrashedCourse(): bool;
}
