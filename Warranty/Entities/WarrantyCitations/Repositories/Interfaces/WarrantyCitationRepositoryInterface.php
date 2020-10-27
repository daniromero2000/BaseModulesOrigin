<?php

namespace Modules\Warranty\Entities\WarrantyCitations\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCitationRepositoryInterface
{
    public function createWarrantyCitation(array $data);

    public function updateWarrantyCitation(array $data);

    public function listWarrantyCitations($totalView): Support;
}
