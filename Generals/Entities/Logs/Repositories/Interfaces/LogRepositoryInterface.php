<?php

namespace  Modules\Generals\Entities\Logs\Repositories\Interfaces;

use  Modules\Generals\Entities\Logs\Log;

interface LogRepositoryInterface
{
    public function createLog($data): Log;
}
