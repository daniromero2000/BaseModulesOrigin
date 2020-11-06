<?php

namespace Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces;

use Modules\Courses\Entities\CourseAttendances\CourseAttendance;
use Illuminate\Support\Collection;

interface CourseAttendanceRepositoryInterface
{
    public function listCourseAttendances(int $totalView);

    public function createCourseAttendance(array $params): CourseAttendance;

    public function findCourseAttendanceById(int $id): CourseAttendance;

    public function findTrashedCourseAttendanceById(int $id): CourseAttendance;

    public function updateCourseAttendance(array $params): bool;

    public function searchCourseAttendance(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCourseAttendance(string $text = null,  $from = null, $to = null);

    public function searchTrashedCourseAttendance(string $text = null): Collection;

    public function deleteCourseAttendance(): bool;

    public function recoverTrashedCourseAttendance(): bool;
}
