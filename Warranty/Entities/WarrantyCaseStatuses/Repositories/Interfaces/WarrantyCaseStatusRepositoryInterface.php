<?php

namespace Modules\Warranty\Entities\WarrantyCaseStatuses\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCaseStatusRepositoryInterface
{
    public function createWarrantyCaseStatus(array $data);

    public function updateWarrantyCaseStatus(array $data);

    public function listWarrantyCaseStatuses($totalView): Support;
}
