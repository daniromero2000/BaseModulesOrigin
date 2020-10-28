<?php

namespace Modules\Leads\Entities\LeadStatusesLogs\Repositories;

use Modules\Leads\Entities\LeadStatusesLogs\LeadStatusesLog;
use Modules\Leads\Entities\LeadStatusesLogs\Repositories\Interfaces\LeadStatusesLogRepositoryInterface;


class LeadStatusesLogRepository implements LeadStatusesLogRepositoryInterface
{
    /**
     * LeadStatusesLogRepository constructor.
     * @param LeadStatusesLog $LeadStatusesLog
     */
    public function __construct(LeadStatusesLog $LeadStatusesLog)
    {
        parent::__construct($LeadStatusesLog);
        $this->model = $LeadStatusesLog;
    }
}
