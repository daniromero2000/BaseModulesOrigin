<?php

namespace Modules\Warranty\Entities\NotRepairedWarranties\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface NotRepairedWarrantyRepositoryInterface
{
    public function createNotRepairedWarranty(array $data);

    public function updateNotRepairedWarranty(array $data);

    public function listNotRepairedWarranties($totalView): Support;
}
