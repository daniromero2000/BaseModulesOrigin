<?php

namespace Modules\Leads\Entities\LeadManagementStatusesLogs\Repositories;

use Modules\Leads\Entities\LeadManagementStatusesLogs\LeadManagementStatusesLog;
use Modules\Leads\Entities\LeadManagementStatusesLogs\Repositories\Interfaces\LeadManagementStatusesLogRepositoryInterface;


class LeadManagementStatusesLogRepository implements LeadManagementStatusesLogRepositoryInterface
{
    /**
     * LeadManagementStatusesLogRepository constructor.
     * @param LeadManagementStatusesLog $LeadManagementStatusesLog
     */
    public function __construct(LeadManagementStatusesLog $leadManagementStatusesLog)
    {
        $this->model = $leadManagementStatusesLog;
    }
}
