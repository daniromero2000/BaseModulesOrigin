<?php

namespace Modules\Pqrs\Entities\PqrCommentaries\Repositories\Interfaces;

interface PqrCommentaryRepositoryInterface
{
    public function createPqrCommentary(array $params);
}
