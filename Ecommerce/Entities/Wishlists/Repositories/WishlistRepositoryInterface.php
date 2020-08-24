<?php

namespace Modules\Ecommerce\Entities\Wishlists\Repositories;

use Modules\Ecommerce\Entities\Wishlists\Wishlist;

interface WishlistRepositoryInterface
{
    public function listWishList($id);

    public function createWishlist(array $wishlist): Wishlist;

    public function deleteWishlist($id);

    public function moveToCartWishlist($id);

    public function listWishlistAdmin();
}
