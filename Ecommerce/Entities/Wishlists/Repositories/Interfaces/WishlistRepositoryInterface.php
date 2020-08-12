<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces;

use Modules\Ecommerce\Entities\Wishlists\Wishlist;
use Illuminate\Support\Collection;

interface WishlistRepositoryInterface
{
    public function createWishlist(array $data): Wishlist;

    // public function updateWishlist(array $params): bool;

    public function findWishlistById(int $id): Wishlist;

    public function listWishlist(string $order = 'id', string $sort = 'desc'): Collection;

    // public function deleteWishlist();

}
