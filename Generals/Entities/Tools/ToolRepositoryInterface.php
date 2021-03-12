<?php

namespace Modules\Generals\Entities\Tools;

interface ToolRepositoryInterface
{
    public function getSkip($RequestSkip);

    public function getPaginate($paginate, $skip, $take = 30);

    public function getClientServerData($paymentDataRequest);

    public function getIpCountry();

    public function deleteThumbFromServer(string $src): bool;
}
