<?php

namespace Modules\Leads\Entities\LeadComments\Repositories\Interfaces;

use Modules\Leads\Entities\LeadComments\LeadComment;

interface LeadCommentRepositoryInterface
{
    public function createLeadComment($data);
}
