<?php

namespace Modules\DocumentManagement\Entities\DocumentCategories\Repositories;

use Modules\DocumentManagement\Entities\DocumentCategories\Repositories\Interfaces\DocumentCategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\DocumentManagement\Entities\DocumentCategories\DocumentCategory;
use Illuminate\Support\Collection as Support;
use Illuminate\Database\Eloquent\Builder;

class DocumentCategoryRepository implements DocumentCategoryRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'is_active',
        'created_at'
    ];

    private $columns2 = [
        'name',
        'company_id',
        'is_active'
    ];

    public function __construct(DocumentCategory $DocumentCategory)
    {
        $this->model = $DocumentCategory;
    }

    public function listDocumentCategories($totalView): Support
    {
        try {
            return  $this->model->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createDocumentCategory(array $params): DocumentCategory
    {
        try {
            return $this->model->create($params);
        } catch (QueryException $e) {
            // throw new CreateDocumentCategoryErrorException($e);
        }
    }

    public function searchDocumentCategory(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                return $this->listDocumentCategories($totalView);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchDocumentCategory($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchDocumentCategory($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'desc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countDocumentCategories(string $text = null,  $from = null, $to = null)
    {
        try {
            if (is_null($text) && is_null($from) && is_null($to)) {
                $data =  $this->model
                    ->get(['id']);
                return count($data);
            }

            if (!is_null($text) && (is_null($from) || is_null($to))) {
                $data =  $this->model->searchDocumentCategory($text, null, true, true)

                    ->get(['id']);
                return count($data);
            }

            if (is_null($text) && (!is_null($from) || !is_null($to))) {
                $data =  $this->model->whereBetween('created_at', [$from, $to])

                    ->get(['id']);
                return count($data);
            }

            $data =  $this->model->searchDocumentCategory($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])

                ->get(['id']);
            return count($data);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDocumentCategoriesForCompanyFront(int $id): Collection
    {
        try {
            return $this->model->where('company_id', $id)
                ->where('id', '!=', 6)
                ->where('id', '!=', 7)
                ->orderBy('created_at', 'desc')->get();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDocumentCategoriesForCompany(int $id): Collection
    {
        try {
            return $this->model->where('company_id', $id)
                ->orderBy('created_at', 'desc')->get();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDocumentCategoryForCompany(int $id, $data): Collection
    {
        try {
            return $this->model->where('company_id', $id)->where('id', $data)
                ->whereHas('documents', function (Builder $query) {
                    return $query->where('is_active', 1);
                })
                ->orderBy('created_at', 'desc')->get();
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateDocumentCategory(array $params)
    {
        try {
            $data = $this->findDocumentCategoryById($params['id']);
            return $data->update($params);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function findDocumentCategoryById(int $id): DocumentCategory
    {
        try {
            $data = $this->model->findOrFail($id, $this->columns);

            return $data;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteDocumentCategory($id): bool
    {
        try {
            $data = $this->findDocumentCategoryById($id);
            return $data->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
