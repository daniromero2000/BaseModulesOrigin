<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories;

use Illuminate\Database\QueryException;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelInterface;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Http\UploadedFile;

class CammodelRepository implements CammodelInterface
{
    use SearchableTrait, UploadableTrait;
    protected $model;
    private $columns = [
        'id',
        'employee_id',
        'manager_id',
        'fake_age',
        'nickname',
        'height',
        'weight',
        'breast_cup_size',
        'tattoos_piercings',
        'meta',
        'slug',
        'likes_dislikes',
        'about_me',
        'private_show',
        'my_rules',
        'cover',
        'cover_page',
        'created_at'
    ];

    public function __construct(Cammodel $cammodel)
    {
        $this->model = $cammodel;
    }

    public function searchCammodel(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->get($this->columns);
        }

        return $this->model->searchEmployee($text)->get($this->columns);
    }

    public function searchTrashedCammodel(string $text = null): Collection
    {
        if (is_null($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function listCammodels(int $totalView)
    {
        try {
            return  $this->model
                ->with('manager')
                ->orderBy('id', 'desc')
                ->skip($totalView)->take(30)
                ->get([
                    'id',
                    'manager_id',
                    'fake_age',
                    'nickname',
                    'meta'
                ]);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function saveCoverPageImage(UploadedFile $file): string
    {
        return $file->store('cammodels', ['disk' => 'public']);
    }

    public function findCammodelById(int $id)
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateCammodel(array $data): bool
    {
        $filtered = collect($data)->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}