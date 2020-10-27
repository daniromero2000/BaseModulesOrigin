<?php

namespace Modules\Warranty\Entities\ItemFailures\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface ItemFailureRepositoryInterface
{
    public function createItemFailure(array $data);

    public function updateItemFailure(array $data);

    public function listItemFailures($totalView): Support;
}
