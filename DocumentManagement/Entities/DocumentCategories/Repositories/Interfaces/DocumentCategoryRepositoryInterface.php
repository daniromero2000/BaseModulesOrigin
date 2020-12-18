<?php

namespace Modules\DocumentManagement\Entities\DocumentCategories\Repositories\Interfaces;

use Modules\DocumentManagement\Entities\DocumentCategories\DocumentCategory;
use Illuminate\Database\Eloquent\Collection;


interface DocumentCategoryRepositoryInterface
{
    public function listDocumentCategories($totalView);

    public function createDocumentCategory(array $params): DocumentCategory;

    public function updateDocumentCategory(array $params);

    public function findDocumentCategoryById(int $id): DocumentCategory;

    public function deleteDocumentCategory($id): bool;

    public function findDocumentCategoriesForCompany(int $id): Collection;

    public function findDocumentCategoriesForCompanyFront(int $id): Collection;

    public function findDocumentCategoryForCompany(int $id, $data): Collection;

    public function searchDocumentCategory(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countDocumentCategories(string $text = null,  $from = null, $to = null);

}
