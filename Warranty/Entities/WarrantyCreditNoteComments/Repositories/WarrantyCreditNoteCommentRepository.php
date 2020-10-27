<?php

namespace Modules\Warranty\Entities\WarrantyCreditNoteComments\Repositories;

use Modules\Warranty\Entities\WarrantyCreditNoteComments\Repositories\Interfaces\WarrantyCreditNoteCommentRepositoryInterface;
use Modules\Warranty\Entities\WarrantyCreditNoteComments\WarrantyCreditNoteComment;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCreditNoteCommentRepository implements WarrantyCreditNoteCommentRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'state',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCreditNoteComment $warrantyCreditNoteComment)
    {
        $this->model = $warrantyCreditNoteComment;
    }

    public function createWarrantyCreditNoteComment(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCreditNoteComment(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCreditNoteComments($totalView): Support
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
