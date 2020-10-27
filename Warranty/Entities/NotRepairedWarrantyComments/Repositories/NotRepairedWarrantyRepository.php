<?php

namespace Modules\Warranty\Entities\NotRepairedWarrantyComments\Repositories;

use Modules\Warranty\Entities\NotRepairedWarrantyComments\Repositories\Interfaces\NotRepairedWarrantyCommentRepositoryInterface;
use Modules\Warranty\Entities\NotRepairedWarrantyComments\NotRepairedWarrantyComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class NotRepairedWarrantyRepository implements NotRepairedWarrantyCommentRepositoryInterface
{
    private $columns = [
        'id',
        'not_repaired_warranty_id',
        'comment',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(NotRepairedWarrantyComment $notRepairedWarrantyComment)
    {
        $this->model = $notRepairedWarrantyComment;
    }

    public function createnotRepairedWarrantyComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updatenotRepairedWarrantyComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listnotRepairedWarrantyComments($totalView): Support
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
