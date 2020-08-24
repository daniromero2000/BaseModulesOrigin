<?php

namespace Modules\Ecommerce\Http\Controllers\Front;

use Modules\Ecommerce\Entities\Wishlists\Repositories\WishlistRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Wishlists\Wishlist;
use Illuminate\Http\Request;
use Modules\Ecommerce\Http\Controllers\Front\wishlistRepository;

class WishlistController extends Controller
{
    private $wishlistInterface;

    public function __construct(
        WishlistRepositoryInterface $wishlistInterface
    ) {
        $this->wishlistInterface  = $wishlistInterface;
    }

    public function index()
    {

        if (!is_null(auth()->user())) {
            return $this->wishlistInterface->listWishList(auth()->user()->id);
        }

        return redirect('login');
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

            return $this->wishlistInterface->createWishlist($data);
        }

        return 'login';
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $this->wishlistInterface->moveToCartWishlist($id);

        return  'true';
    }

    public function destroy($id)
    {
        $this->wishlistInterface->deleteWishlist($id);

        return redirect()->route('accounts',  ['tab' => 'wishlist'])
            ->with('message', 'Eliminado Satisfactoriamente');
    }
}
