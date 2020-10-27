<?php

namespace Modules\Warranty\Entities\WarrantyCreditNotes\Repositories\Interfaces;

use Illuminate\Support\Collection as Support;

interface WarrantyCreditNoteRepositoryInterface
{
    public function createWarrantyCreditNote(array $data);

    public function updateWarrantyCreditNote(array $data);

    public function listWarrantyCreditNotes($totalView): Support;
}
