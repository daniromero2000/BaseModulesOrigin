<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Wishlist;

use Modules\Ecommerce\Entities\Wishlists\Repositories\WishlistRepositoryInterface;
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
        // if(!is_null(auth()->user())){
        //     return $this->wishlistRepo->listWishList(auth()->user()->id);
        // }

        // return redirect('admin.login');
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
        // $this->wishlistRepo->createWishlist($request->all());

        // return redirect()->route('admin.brands.wishlist')
        //     ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update($request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
