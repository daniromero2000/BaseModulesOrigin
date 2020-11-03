<?php

namespace Modules\Generals\Entities\ManagementStatuses\Repositories\Interfaces;


interface ManagementStatusRepositoryInterface
{
    public function getStatusesForType($type);
}
