<?php

namespace Modules\Blog\Entities\WinkPosts\Repositories\Interfaces;

use Modules\Blog\WinkPost;
use Illuminate\Database\Eloquent\Collection;

interface WinkPostRepositoryInterface
{
    public function listWinkPosts($totalView);

    public function findWinkPostById(int $id): WinkPost;

    public function searchWinkPost(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countWinkPosts(string $text = null,  $from = null, $to = null);

}
