<?php

namespace Modules\Leads\Entities\LeadComments\Repositories;

use Modules\Leads\Entities\LeadComments\LeadComment;
use Modules\Leads\Entities\LeadComments\Repositories\Interfaces\LeadCommentRepositoryInterface;
use Illuminate\Database\QueryException;

class LeadCommentRepository implements LeadCommentRepositoryInterface
{
    public function __construct(
        LeadComment $LeadComment
    ) {
        $this->model = $LeadComment;
    }

    public function createLeadComment($data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
