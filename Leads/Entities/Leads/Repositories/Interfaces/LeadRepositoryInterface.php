<?php

namespace Modules\Leads\Entities\Leads\Repositories\Interfaces;

use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function listLeads($employee, int $totalView, $deparment);

    public function createLead(array $data): Lead;

    public function updateLead($id, array $data);

    public function findLeadByIdFull(int $id): Lead;

    public function searchLeads($employee, string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function exportLeads(string $text = null, $from = null, $to = null): Collection;

    public function countLeads($employee, string $text = null,  $from = null, $to = null);
    
}
