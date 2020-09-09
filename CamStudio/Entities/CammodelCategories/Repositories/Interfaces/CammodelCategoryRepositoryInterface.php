<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces;

use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Illuminate\Support\Collection;

interface CammodelCategoryRepositoryInterface
{
    public function listCammodelCategories(string $order = 'id', string $sort = 'desc', $except = []): Collection;

    public function createCammodelCategory(array $params): CammodelCategory;

    public function updateCammodelCategory(array $params): CammodelCategory;

    public function findCammodelCategoryById(int $id): CammodelCategory;

    public function deleteCammodelCategory(): bool;

    public function updateSortOrder(array $data);

    public function associateCammodel(Cammodel $product);

    public function findCammodels(): Collection;

    public function findCammodelsSkip($totalviews): Collection;

    public function countCammodels();

    public function syncCammodels(array $params);

    public function detachCammodels();

    public function deleteFile(array $file, $disk = null): bool;

    public function findCammodelCategoryBySlug(array $slug): CammodelCategory;
}