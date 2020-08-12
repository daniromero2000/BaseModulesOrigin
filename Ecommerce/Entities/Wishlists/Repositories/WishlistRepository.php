<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories;

use Modules\Ecommerce\Entities\Wishlists\Wishlist;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces\WishlistRepositoryInterface;

class WishlistRepository implements WishlistRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'product_id',
        'customer_id',
        'moved_to_cart',
        'shared',
        'time_of_moving',
    ];

    public function __construct(Wishlist $wishlist)
    {
        $this->model = $wishlist;
    }

    public function createWishlist(array $params): Wishlist
    {

    }

    public function updateWhishlist(array $params): bool
    {

    }

    public function findWishlistById(int $id): Wishlist
    {

    }

    public function listWishlist(string $order = 'id', string $sort = 'desc'): Collection
    {
        return $this->model->all($this->columns, $order, $sort);
    }

    public function deleteCourier()
    {
        return $this->model->delete();
    }
}
