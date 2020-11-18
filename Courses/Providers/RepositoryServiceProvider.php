<?php

namespace Modules\Courses\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Courses\Entities\Students\Repositories\StudentRepository;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;
use Modules\Courses\Entities\Courses\Repositories\CourseRepository;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;
use Modules\Courses\Entities\CourseAttendances\Repositories\CourseAttendanceRepository;
use Modules\Courses\Entities\CourseAttendances\Repositories\Interfaces\CourseAttendanceRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            CourseAttendanceRepositoryInterface::class,
            CourseAttendanceRepository::class
        );

        $this->app->bind(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );

        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );
    }
}
