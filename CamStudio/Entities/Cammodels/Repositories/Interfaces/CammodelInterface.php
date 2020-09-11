<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces;

use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

interface CammodelInterface
{
    public function searchCammodel(string $text = null): Collection;

    public function searchTrashedCammodel(string $text = null): Collection;

    public function listCammodels(int $totalView);

    public function findCammodelById(int $id);

    public function saveCoverPageImage(UploadedFile $file): string;

    public function updateCammodel(array $data): bool;
}