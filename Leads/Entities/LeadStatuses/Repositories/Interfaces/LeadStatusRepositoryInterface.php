<?php

namespace Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces;

interface LeadStatusRepositoryInterface
{
    public function getAllLeadStatusesNames();

    public function getLeadStatusesForServices($id);
}
