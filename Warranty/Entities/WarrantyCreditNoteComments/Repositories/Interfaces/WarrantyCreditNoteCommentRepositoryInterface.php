<?php

namespace Modules\Warranty\Entities\WarrantyCreditNoteComments\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCreditNoteCommentRepositoryInterface
{
    public function createWarrantyCreditNoteComment(array $data);

    public function updateWarrantyCreditNoteComment(array $data);

    public function listWarrantyCreditNoteComments($totalView): Support;
}
