<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories;

use Illuminate\Database\QueryException;
use Modules\Ecommerce\Entities\Products\Exceptions\WishlistCreateErrorException;
use Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces\WishlistRepositoryInterface;
use Modules\Ecommerce\Entities\Wishlists\Wishlist;

class WishlistRepository implements WishlistRepositoryInterface
{
    protected $model;
    private $columns = [
        'product_id',
        'customer_id',
        'moved_to_cart',
        'shared',
        'time_of_moving',
        'created_at'
    ];

    public function __construct(
        Wishlist $Wishlist
    ) {
        $this->model = $Wishlist;
    }

    public function listWishList($id)
    {
        return $this->model->with('product')
            ->where('customer_id', $id)
            ->where('moved_to_cart', null)
            ->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function createWishlist(array $data): Wishlist
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new WishlistCreateErrorException($e);
        }
    }

    public function deleteWishlist($id)
    {
        $data = $this->model->findOrFail($id);
        return  $data->delete();
    }

    public function moveToCartWishlist($id)
    {
        $data = $this->model->findOrFail($id);
        $date = ['moved_to_cart' => date("Y-m-d")];
        return  $data->update($date);
    }

    public function listWishListAdmin()
    {
        return $this->model->orderBy('created_at', 'desc')
            ->get($this->columns);
    }
}
