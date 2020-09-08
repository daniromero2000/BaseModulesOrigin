<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Wishlist;

use Modules\Ecommerce\Entities\Wishlists\Repositories\Interfaces\WishlistRepositoryInterface;
use Modules\Ecommerce\Entities\Wishlists\Repositories\WishlistRepository;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private $wishlistRepo;

    public function __construct(WishlistRepositoryInterface $wishlistInterface)
    {
        $this->wishlistRepo  = $wishlistInterface;
    }

    public function index()
    {
        return view('ecommerce::admin.wishlist.list', [
            'wishlist' => $this->wishlistRepo->listWishListAdmin()
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.wishlist.create');
    }

    public function store(Request $request)
    {
        if (!is_null(auth()->user())) {
            $data = [
                'product_id' => $request->input('id'),
                'customer_id' => auth()->user()->id
            ];

            return $this->wishlistRepo->createWishlist($data);
        }
    }
}
