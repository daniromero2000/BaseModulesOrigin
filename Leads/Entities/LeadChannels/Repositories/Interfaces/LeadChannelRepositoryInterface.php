<?php

namespace Modules\Leads\Entities\LeadChannels\Repositories\Interfaces;

use Modules\Leads\Entities\LeadChannels\LeadChannel;


interface LeadChannelRepositoryInterface
{
    public function getAllLeadChannelsNames($select = ['*']);

    public function createLeadChannel($data);

    public function updateLeadChannel($params);

    public function findLeadChannelById(int $id): LeadChannel;
}
