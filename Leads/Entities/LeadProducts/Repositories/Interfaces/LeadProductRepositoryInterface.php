<?php

namespace Modules\Leads\Entities\LeadProducts\Repositories\Interfaces;

interface LeadProductRepositoryInterface
{
    public function getAllLeadProductNames();

    public function getLeadProductForService($id);

    public function syncDeparments(array $ids);

    public function getProductsForDepartment($id);
}
