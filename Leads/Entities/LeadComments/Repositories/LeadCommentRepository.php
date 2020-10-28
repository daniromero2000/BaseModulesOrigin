<?php

namespace Modules\Leads\Entities\LeadComments\Repositories;

use Modules\Leads\Entities\LeadComments\LeadComment;
use Modules\Leads\Entities\LeadComments\Repositories\Interfaces\LeadCommentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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

    public function findLeadCommentById(int $id): LeadComment
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findLeadCommentByName($name): LeadComment
    {
        try {
            return $this->model->findOrFail($name);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateLeadComment(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
