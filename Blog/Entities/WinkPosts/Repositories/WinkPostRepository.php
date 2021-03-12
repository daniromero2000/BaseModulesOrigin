<?php

namespace Modules\Blog\Entities\WinkPosts\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Modules\Blog\WinkPost;
use Illuminate\Support\Collection as Support;
use Modules\Blog\Entities\WinkPosts\Repositories\Interfaces\WinkPostRepositoryInterface;

class WinkPostRepository implements WinkPostRepositoryInterface
{
    protected $model;
    private $columns = [
        '*'
    ];

    public function __construct(WinkPost $WinkPost)
    {
        $this->model = $WinkPost;
    }

    public function listWinkPosts($totalView): Support
    {
        try {
            return  $this->model->orderBy('publish_date', 'DESC')
                ->where('published', 1)
                ->skip($totalView)
                ->take(15)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function searchWinkPost(string $text = null, int $totalView, $from = null, $to = null): Collection
    {
        try {
            if (empty($text) && is_null($from) && is_null($to)) {
                return $this->listWinkPosts($totalView);
            }

            if (!empty($text) && (is_null($from) || is_null($to))) {
                return $this->model->searchWinkPost($text, null, true, true)
                    ->where('published', 1)
                    ->skip($totalView)
                    ->take(15)
                    ->get($this->columns);
            }

            if (empty($text) && (!is_null($from) || !is_null($to))) {
                return $this->model->whereBetween('created_at', [$from, $to])
                    ->skip($totalView)
                    ->where('published', 1)
                    ->take(15)
                    ->get($this->columns);
            }

            return $this->model->searchWinkPost($text, null, true, true)
                ->whereBetween('created_at', [$from, $to])
                ->where('published', 1)
                ->orderBy('publish_date', 'DESC')
                ->skip($totalView)
                ->take(15)
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function countWinkPosts(string $text = null,  $from = null, $to = null)
    {
        if (empty($text) && is_null($from) && is_null($to)) {
            return $this->model->where('published', 1)->count();
        }

        if (!empty($text) && (is_null($from) || is_null($to))) {
            return $this->model->searchWinkPost($text, null, true, true)->where('published', 1)->count();
        }

        if (empty($text) && (!is_null($from) || !is_null($to))) {
            return  $this->model->whereBetween('created_at', [$from, $to])->where('published', 1)->count();
        }

        return $this->model->searchWinkPost($text, null, true, true)
            ->whereBetween('created_at', [$from, $to])->where('published', 1)->count();
    }

    public function findWinkPostById(int $id): WinkPost
    {
        try {
            $WinkPost = $this->model->findOrFail($id, $this->columns);

            return $WinkPost;
        } catch (ModelNotFoundException $e) {
            abort(503, $e->getMessage());
        }
    }

}
