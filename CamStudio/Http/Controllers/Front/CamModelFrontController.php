<?php

namespace Modules\CamStudio\Http\Controllers\Front;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;


class CamModelFrontController extends Controller
{
    private $camModelInterface;

    public function __construct(CammodelRepositoryInterface $cammodelRepositoryInterface)
    {
        $this->camModelInterface = $cammodelRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('camstudio::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('camstudio::create');
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
        return view('camstudio::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('camstudio::edit');
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

    public function getCamModel($slug)
    {
        $camModel = $this->camModelInterface->findCammodelBySlug($slug);

        return view('camstudio::front.profile-model', [
            'camModel' => $camModel
        ]);
    }
}
