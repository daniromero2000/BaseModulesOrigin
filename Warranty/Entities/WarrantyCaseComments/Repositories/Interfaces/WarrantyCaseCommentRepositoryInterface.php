<?php

namespace Modules\Warranty\Entities\WarrantyCaseComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCaseCommentRepositoryInterface
{
    public function createWarrantyCaseComment(array $data);

    public function updateWarrantyCaseComment(array $data);

    public function listWarrantyCaseComments($totalView): Support;
}
