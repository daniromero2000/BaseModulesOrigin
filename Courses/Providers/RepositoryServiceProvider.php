<?php

namespace Modules\Courses\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Courses\Entities\Students\Repositories\StudentRepository;
use Modules\Courses\Entities\Students\Repositories\Interfaces\StudentRepositoryInterface;
use Modules\Courses\Entities\Courses\Repositories\CourseRepository;
use Modules\Courses\Entities\Courses\Repositories\Interfaces\CourseRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
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
