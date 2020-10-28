<?php

namespace Modules\Leads\Entities\Leads\Repositories\Interfaces;

use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function createLead(array $data);

    public function findLeadByIdFull(int $id): Lead;
}
