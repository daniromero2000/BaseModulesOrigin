<?php

namespace Modules\Leads\Entities\LeadInformations\Repositories\Interfaces;

use Modules\Leads\Entities\LeadInformations\LeadInformation;


interface LeadInformationRepositoryInterface
{
    public function createLeadInformation($data);

    public function updateLeadInformation($params);

    public function findLeadInformationById(int $id): LeadInformation;
}
