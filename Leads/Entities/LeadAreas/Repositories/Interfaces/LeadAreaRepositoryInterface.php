<?php

namespace Modules\Leads\Entities\LeadAreas\Repositories\Interfaces;

use Modules\Leads\Entities\LeadAreas\LeadArea;


interface LeadAreaRepositoryInterface
{
    public function createLeadArea($data);

    public function updateLeadArea($params);

    public function findLeadAreaById(int $id): LeadArea;
}
