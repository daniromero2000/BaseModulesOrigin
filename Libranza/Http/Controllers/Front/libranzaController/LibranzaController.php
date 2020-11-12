<?php

namespace Modules\Libranza\Http\Controllers\Front\libranzaController;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;

class LibranzaController extends Controller
{

    private $cityInterface;

    public function __construct(
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->cityInterface  = $cityRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */

    public function subForm()
    {
        return view('libranza.front.sub_index', [
            'cities' => $this->cityInterface->listCities()
        ]);
    }

    public function thankYou()
    {
        return view('libranza.front.thank_you_page');
    }

    public function index()
    {
        return view('libranza::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('libranza::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('libranza::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('libranza::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
