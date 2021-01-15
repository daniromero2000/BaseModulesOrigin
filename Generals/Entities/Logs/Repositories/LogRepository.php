<?php

namespace  Modules\Generals\Entities\Logs\Repositories;

use  Modules\Generals\Entities\Logs\Log;
use  Modules\Generals\Entities\Logs\Repositories\Interfaces\LogRepositoryInterface;
use Illuminate\Database\QueryException;

class LogRepository implements LogRepositoryInterface
{
    private $columns = [
        'data',
        'response'
    ];

    public function __construct(
        Log $Log
    ) {
        $this->model = $Log;
    }

    public function createLog($data): Log
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw dd($e);
        }
    }
}
