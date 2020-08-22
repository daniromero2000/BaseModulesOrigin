<?php

namespace Modules\Companies\Entities\CompanyReviews\Repositories\Interfaces;

interface CompanyReviewRepositoryInterface
{
    public function createCompanyReview(array $params);

    public function findFrontCompanyReviewById(int $id): Customer;
}
