<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces;

use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Support\Collection;

interface CammodelRepositoryInterface
{
    public function searchCammodel(string $text = null): Collection;

    public function searchTrashedCammodel(string $text = null): Collection;

    public function listCammodels(int $totalView);

    public function findCammodelById(int $id);
}