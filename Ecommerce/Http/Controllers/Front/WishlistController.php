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

        if(!is_null(auth()->user())){
            return $this->wishlistInterface->listWishList(auth()->user()->id);
        }

        return redirect('login');

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
            return $this->wishlistInterface->createWishlist($data);
        }

        return 'login';

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
    public function update(Request $request, $id)
    {
      $data = $this->wishlistInterface->moveToCartWishlist($id);

      return  'true';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->wishlistInterface->deleteWishlist($id);

        return redirect()->route('accounts',  ['tab' => 'wishlist'])
            ->with('message', 'Eliminado Satisfactoriamente');
    }
}
