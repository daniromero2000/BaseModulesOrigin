<?php

namespace Modules\Warranty\Entities\WarrantyCitationComments\Repositories;



use Modules\Warranty\Entities\WarrantyCitationComments\Repositories\Interfaces\WarrantyCitationCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCitationComments\WarrantyCitationComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCitationCommentRepository implements WarrantyCitationCommentRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_citation_id',
        'comment',
        'employee_id'.
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCitationComment $warrantyCitationComment)
    {
        $this->model = $warrantyCitationComment;
    }

    public function createWarrantyCitationComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCitationComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCitationComments($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

}
