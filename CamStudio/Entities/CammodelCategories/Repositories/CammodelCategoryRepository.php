<?php

namespace Modules\CamStudio\Entities\CammodelCategories\Repositories;

use Modules\CamStudio\Entities\CammodelCategories\CammodelCategory;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;

class CammodelCategoryRepository implements CammodelCategoryRepositoryInterface
{
    use UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'name',
        'slug',
        'description',
        'cover',
        'is_active',
    ];

    public function __construct(CammodelCategory $category)
    {
        $this->model = $category;
    }

    public function searchCammodelCategories(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchCammodelCategories($text)->get($this->columns);
    }

    public function searchTrashedCammodelCategories(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function listCammodelCategories(string $order = 'sort_order', string $sort = 'asc', $except = []): Collection
    {
        return $this->model->orderBy($order, $sort)
            ->get($this->columns)->except($except);
    }

    public function listCammodelCategoriesSkip(int $totalView): Collection
    {
        try {
            return  $this->model
                ->orderBy('id', 'desc')
                ->skip($totalView)->take(30)
                ->get();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function createCammodelCategory(array $params): CammodelCategory
    {
        try {
            $collection = collect($params);
            if (isset($params['name'])) {
                $slug = str_slug($params['name']);
            }

            if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
                $cover = $this->uploadOne($params['cover'], 'categories');
            }

            $merge = $collection->merge(compact('slug', 'cover'));
            $category = new CammodelCategory($merge->all());

            if (isset($params['parent'])) {
                $parent = $this->findCammodelCategoryById($params['parent']);
                $category->parent()->associate($parent);
            }

            $category->save();
            return $category;
        } catch (QueryException $e) {
            dd($e->getMessage());
        }
    }

    public function findCammodelOrder()
    {
        return $this->model->cammodelOrder;
    }

    public function updateCammodelCategory(array $params): CammodelCategory
    {
        $category = $this->findCammodelCategoryById($this->model->id);
        $collection = collect($params)->except('_token');
        $slug = str_slug($collection->get('name'));

        if (isset($params['cover']) && ($params['cover'] instanceof UploadedFile)) {
            $cover = $this->uploadOne($params['cover'], 'categories');
        }

        $merge = $collection->merge(compact('slug', 'cover'));

        // set parent attribute default value if not set
        $params['parent'] = $params['parent'] ?? 0;

        // If parent category is not set on update
        // just make current category as root
        // else we need to find the parent
        // and associate it as child
        if ((int) $params['parent'] == 0) {
            $category->saveAsRoot();
        } else {
            $parent = $this->findCammodelCategoryById($params['parent']);
            $category->parent()->associate($parent);
        }

        $category->update($merge->all());

        return $category;
    }

    public function findCammodelCategoryById(int $id): CammodelCategory
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            dd($e->getMessage());
        }
    }

    public function deleteCammodelCategory(): bool
    {
        return $this->model->delete();
    }

    public function associateCammodel(Cammodel $product)
    {
        return $this->model->products()->save($product);
    }

    public function findCammodels(): Collection
    {
        return $this->model->products;
    }

    public function countCammodels()
    {
        return $this->model->countCammodels;
    }

    public function findCammodelsSkip($totalviews): Collection
    {
        return $this->model->products
            ->skip($totalviews)
            ->take(30);
    }

    public function updateSortOrder(array $data)
    {
        try {
            return $this->model->where('id', $data['id'])
                ->update($data);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function syncCammodels(array $params)
    {
        $this->model->products()->sync($params);
    }

    public function detachCammodels()
    {
        $this->model->products()->detach();
    }

    public function deleteFile(array $file, $disk = null): bool
    {
        return $this->model->where('id',  $file['category'])
            ->update(['cover' => null]);
    }

    public function findCammodelCategoryBySlug(array $slug): CammodelCategory
    {
        try {
            return $this->model->where('slug', $slug)
                ->first($this->columns);
        } catch (ModelNotFoundException $e) {
            dd($e);
        }
    }

    public function findParentCammodelCategory()
    {
        return $this->model->parent;
    }
}
