<?php

namespace Modules\Leads\Entities\LeadStatuses\Repositories\Interfaces;

interface LeadStatusRepositoryInterface
{
    public function getAllLeadStatusesNames($select = ['*']);

    public function getLeadStatusesForServices($id);
}
