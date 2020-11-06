<?php

namespace Modules\Courses\Entities\Courses\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Modules\Courses\Entities\Courses\Course;

interface CourseRepositoryInterface
{
    public function listCourses(int $totalView);

    public function listCoursesFront();

    public function createCourse(array $params): Course;

    public function findCourseById(int $id): Course;

    public function findCourseBySlug($id): Course;

    public function findTrashedCourseById(int $id): Course;

    public function saveCoverImage(UploadedFile $file): string;

    public function updateCourse(array $params): bool;

    public function searchCourse(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCourse(string $text = null,  $from = null, $to = null);

    public function searchTrashedCourse(string $text = null): Collection;

    public function deleteCourse(): bool;

    public function recoverTrashedCourse(): bool;
}
