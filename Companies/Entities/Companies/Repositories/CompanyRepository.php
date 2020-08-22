<?php

namespace Modules\Companies\Entities\Companies\Repositories;

use Modules\Companies\Entities\Companies\Company;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class CompanyRepository implements CompanyRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'identification',
        'logo',
        'is_active',
    ];

    public function __construct(Company $company)
    {
        $this->model = $company;
    }

    public function listCompanies(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('name', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createCompany(array $params): Company
    {
        try {
            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }
            if (isset($params['logo']) && ($params['logo'] instanceof UploadedFile)) {
                $logo = $this->uploadOne($params['logo'], 'companies');
            }
            $merge = $collection->merge(compact('logo'));
            $company = new Company($merge->all());
            $company->save();

            return $company;
            //return $this->model->create($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCompany(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findCompanyById(int $id): Company
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteCompany(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchCompany(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->get($this->columns);
            }

            return $this->model->searchCompany($text)->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchTrashedCompany(string $text = null): Collection
    {
        try {
            if (is_null($text)) {
                return $this->model->onlyTrashed()->get($this->columns);
            }

            return $this->model->onlyTrashed()->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findFrontCompanyReviewById()
    {
        try {
            return $this->model->orderBy('name', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
