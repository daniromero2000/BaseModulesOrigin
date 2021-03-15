<?php

namespace Modules\Libranza\Entities\BannerManagements\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Libranza\Entities\BannerManagements\BannerManagement;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Libranza\Entities\BannerManagements\Repositories\Interfaces\BannerManagementRepositoryInterface;

class BannerManagementRepository implements BannerManagementRepositoryInterface
{
    use UploadableTrait;

    protected $model;
    private $columns = [
        'id',
        'name',
        'alt',
        'is_active',
        'sort_order',
        'src'
    ];

    private $listColumns = [
        'id',
        'name',
        'alt',
        'is_active',
        'sort_order',
        'src'
    ];

    private $campaignRequestColumns = [
        'id',
        'name',
        'alt',
        'is_active',
        'sort_order',
        'src'
    ];

    public function __construct(BannerManagement $campaignRequest)
    {
        $this->model = $campaignRequest;
    }

    public function listBannerManagements(int $totalView)
    {
        try {
            return  $this->model
                ->orderBy('sort_order', 'asc')
                ->skip($totalView)->take(30)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listBannerManagementsForFront()
    {
        try {
            return  $this->model
                ->orderBy('sort_order', 'asc')
                ->where('is_active', 1)
                ->get($this->listColumns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchBannerManagement(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listBannerManagements($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchBannerManagement($text, null, true, true)
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->take(30)
                    ->get($this->columns);
            }

            return $this->model->searchBannerManagement($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('sort_order', 'asc')
                ->skip($totalView)
                ->take(30)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countBannerManagements(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->count('id');
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchBannerManagement($text, null, true, true)
                ->count('id');
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return $this->model->whereBetween('created_at', [$from, $to])
                ->count('id');
        }

        return $this->model->searchBannerManagement($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])
            ->count('id');
    }

    public function searchTrashedBannerManagement(string $text = null): Collection
    {
        if (empty($text)) {
            return $this->model->onlyTrashed($text)->get($this->columns);
        }

        return $this->model->onlyTrashed()->get($this->columns);
    }

    public function createBannerManagement(array $data): BannerManagement
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            // throw new CreateManagementErrorException($e);
        }
    }

    public function findBannerManagementById(int $id): BannerManagement
    {
        try {
            return $this->model->findOrFail($id, $this->campaignRequestColumns);
        } catch (ModelNotFoundException $e) {
            // throw new ManagementNotFoundException($e);
        }
    }

    public function findTrashedBannerManagementById(int $id): BannerManagement
    {
        try {
            return $this->model->withTrashed()->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            // throw new ManagementNotFoundException($e);
        }
    }

    public function updateBannerManagement(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            // throw new UpdateManagementErrorException($e);
        }
    }

    public function saveImage($params): string
    {

        return $this->uploadOne($params['image'], 'banners', 'public', str_slug($params['name']));
    }

    public function deleteBannerManagement(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function recoverTrashedBannerManagement(): bool
    {
        try {
            return $this->model->restore();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function updateSortOrder(array $data)
    {
        return $this->model->where('id', $data['id'])->update($data);
    }
}
