<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Wishlist;

use Modules\Ecommerce\Entities\Wishlists\Repositories\WishlistRepositoryInterface;
use Modules\Ecommerce\Entities\Wishlists\Repositories\WishlistRepository;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Wishlists\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    private $wishlistRepo;

    public function __construct( WishlistRepositoryInterface $wishlistInterface)
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
        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ecommerce::admin.wishlist.create');
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!is_null(auth()->user())){
            $data = ['product_id'=> $request->input('id'), 'customer_id' =>auth()->user()->id];
            return $this->wishlistRepo->createWishlist($data);
        }
        // $this->wishlistRepo->createWishlist($request->all());

        // return redirect()->route('admin.brands.wishlist')
        //     ->with('message', config('messaging.create'));
    }
        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
