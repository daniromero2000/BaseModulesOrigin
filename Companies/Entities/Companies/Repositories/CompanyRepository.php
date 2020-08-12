<?php

namespace Modules\Companies\Entities\Companies\Repositories;

use Modules\Companies\Entities\Companies\Company;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Illuminate\Database\QueryException;

class CompanyRepository implements CompanyRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'name', 'description', 'is_active'];

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function listCompanies()
    {
        try {
            return  $this->model
                ->orderBy('name', 'desc')
                //->skip($totalView)->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
