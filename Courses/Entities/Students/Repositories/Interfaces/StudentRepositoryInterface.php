<?php

namespace Modules\Courses\Entities\Students\Repositories\Interfaces;

use Modules\Courses\Entities\Students\Student;
use Illuminate\Support\Collection;

interface StudentRepositoryInterface
{
    public function listStudents(int $totalView);

    public function createStudent(array $params): Student;

    public function findStudentById(int $id): Student;

    public function findTrashedStudentById(int $id): Student;

    public function updateStudent(array $params): bool;

    public function findStudentByIdentification(int $id);

    public function searchStudent(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countStudents(string $text = null,  $from = null, $to = null);

    public function searchTrashedStudent(string $text = null): Collection;

    public function deleteStudent(): bool;

    public function recoverTrashedStudent(): bool;
}
