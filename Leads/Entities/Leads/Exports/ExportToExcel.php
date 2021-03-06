<?php

namespace Modules\Leads\Entities\Leads\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ExportToExcel implements FromArray
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }
}
