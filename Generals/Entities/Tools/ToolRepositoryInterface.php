<?php

namespace Modules\Generals\Entities\Tools;

interface ToolRepositoryInterface
{
    public function getSkip($RequestSkip);

    public function getClientServerData($paymentDataRequest);
}
