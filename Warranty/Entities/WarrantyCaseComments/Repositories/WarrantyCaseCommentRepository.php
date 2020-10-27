<?php

namespace Modules\Warranty\Entities\WarrantyCaseComments\Repositories;

use Modules\Warranty\Entities\WarrantyCaseComments\Repositories\Interfaces\WarrantyCaseCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCaseComments\WarrantyCaseComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCaseCommentRepository implements WarrantyCaseCommentRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'employee_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCaseComment $warrantyCaseComment)
    {
        $this->model = $warrantyCaseComment;
    }

    public function createWarrantyCaseComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCaseComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCaseComments($totalView): Support
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
