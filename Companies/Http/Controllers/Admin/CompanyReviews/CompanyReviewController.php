<?php

namespace Modules\Companies\Http\Controllers\Admin\CompanyReviews;

use Modules\Companies\Entities\CompanyReviews\Repositories\Interfaces\CompanyReviewRepositoryInterface;
use Modules\Companies\Entities\CompanyReviews\Requests\CreateCompanyReviewRequest;
use App\Http\Controllers\Controller;

class CompanyReviewController extends Controller
{
    private $companyReviewInterface;

    public function __construct(
        CompanyReviewRepositoryInterface $companyReviewRepositoryInterface
    ) {
        $this->companyReviewInterface = $companyReviewRepositoryInterface;
    }

    public function store(CreateCompanyReviewRequest $request)
    {
        $this->companyReviewInterface->createCompanyReview($request->except('_token', '_method'));
        $request->session()->flash('message', 'Calificación Exitosa!');

        return back();
    }
}
