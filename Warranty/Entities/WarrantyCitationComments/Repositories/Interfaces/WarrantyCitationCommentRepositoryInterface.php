<?php

namespace Modules\Warranty\Entities\WarrantyCitationComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCitationCommentRepositoryInterface
{
    public function createWarrantyCitationComment(array $data);

    public function updateWarrantyCitationComment(array $data);

    public function listWarrantyCitationComments($totalView): Support;
}
