<?php

namespace Modules\Leads\Entities\Leads\Repositories\Interfaces;

use Modules\Leads\Entities\Leads\Lead;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Collection;

interface LeadRepositoryInterface
{
    public function listLeads(int $totalView, $deparment);

    public function createLead(array $data): Lead;

    public function updateLead($id, array $data);

    public function findLeadByIdFull(int $id): Lead;

    public function searchLeads(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function searchTrashedLead(string $text = null): Collection;
}
