<?php

namespace Modules\Companies\Entities\Companies\Repositories\Interfaces;

use Modules\Companies\Entities\Companies\Company;
use Illuminate\Support\Collection;

interface CompanyRepositoryInterface
{
    public function listCompanies(int $totalView);

    public function listCompaniesActives();

    public function createCompany(array $params): Company;

    public function findCompanyById(int $id): Company;

    public function deleteCompany(): bool;

    public function searchCompany(string $text): Collection;

    public function findFrontCompanyReviewById();
}
