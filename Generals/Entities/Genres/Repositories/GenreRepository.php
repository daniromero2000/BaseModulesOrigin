<?php

namespace Modules\Generals\Entities\Genres\Repositories;

use Modules\Generals\Entities\Genres\Genre;
use Modules\Generals\Entities\Genres\Repositories\Interfaces\GenreRepositoryInterface;
use Illuminate\Database\QueryException;

class GenreRepository implements GenreRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'genre'];

    public function __construct(
        Genre $Genre
    ) {
        $this->model = $Genre;
    }

    public function getAllGenresNames()
    {
        try {
            return $this->model->orderBy('genre', 'asc')
                ->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }
}
