<?php

namespace Modules\Warranty\Entities\NotRepairedWarrantyComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface NotRepairedWarrantyCommentRepositoryInterface
{
    public function createNotRepairedWarrantyComment(array $data);

    public function updateNotRepairedWarrantyComment(array $data);

    public function listNotRepairedWarrantyComments($totalView): Support;
}
