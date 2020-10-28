<?php

namespace Modules\Leads\Entities\LeadComments\Repositories\Interfaces;

use Modules\Leads\Entities\LeadComments\LeadComment;

interface LeadCommentRepositoryInterface
{
    public function createLeadComment($data);

    public function updateLeadComment(array $params): bool;

    public function findLeadCommentById(int $id): LeadComment;

    public function findLeadCommentByName($name): LeadComment;
}
