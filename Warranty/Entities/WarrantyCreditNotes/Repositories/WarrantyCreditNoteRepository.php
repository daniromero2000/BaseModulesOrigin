<?php

namespace Modules\Warranty\Entities\WarrantyCreditNotes\Repositories;

use Modules\Warranty\Entities\WarrantyCreditNotes\WarrantyCreditNote;
use Modules\Warranty\Entities\WarrantyCreditNotes\Repositories\Interfaces\WarrantyCreditNoteRepositoryInterface;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\QueryException;

class WarrantyCreditNoteRepository implements WarrantyCreditNoteRepositoryInterface
{
    private $columns = [
        'id',
        'warranty_case_id',
        'state',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function __construct(WarrantyCreditNote $warrantyCreditNote)
    {
        $this->model = $warrantyCreditNote;
    }

    public function createWarrantyCreditNote(array $data)
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateWarrantyCreditNote(array $data)
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listWarrantyCreditNotes($totalView): Support
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
