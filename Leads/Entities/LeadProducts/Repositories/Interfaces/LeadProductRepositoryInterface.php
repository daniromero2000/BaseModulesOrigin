<?php

namespace Modules\Leads\Entities\LeadProducts\Repositories\Interfaces;

interface LeadProductRepositoryInterface
{
    public function getAllLeadProductNames();

    public function getLeadProductForService($id);
}
