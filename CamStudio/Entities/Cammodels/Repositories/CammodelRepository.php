<?php

namespace Modules\CamStudio\Entities\Cammodels\Repositories;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\CamStudio\Entities\CammodelImages\CammodelImage;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelInterface;

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
        'image_tks',
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

    public function saveCammodelImages(Collection $collection)
    {
        $collection->each(function (UploadedFile $file) {
            $filename = $this->storeFile($file, 'Cammodels');
            $CammodelImage = new CammodelImage([
                'Cammodel_id' => $this->model->id,
                'src' => $filename
            ]);
            $this->model->images()->save($CammodelImage);
        });
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
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function deleteThumb(string $src): bool
    {
        return DB::table('cammodel_images')
            ->where('src', $src)
            ->delete();
    }

    public function syncCategories(array $params)
    {

        // dd($this->model->categories()->sync($params));
        try {
            $this->model->categories()->sync($params);
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function detachCategories()
    {
        $this->model->categories()->detach();
    }
}