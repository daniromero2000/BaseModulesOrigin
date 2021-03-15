<?php

namespace Modules\Libranza\Http\Controllers\Admin\BannerManagements;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Libranza\Entities\BannerManagements\Services\Interfaces\BannerManagementServiceInterface;

class BannerManagementController extends Controller
{

    protected $bannerManagementInterface;

    public function __construct(BannerManagementServiceInterface $bannerManagementServiceInterface)
    {
        $this->bannerManagementInterface = $bannerManagementServiceInterface;
    }

    public function index(Request $request)
    {
        $response = $this->bannerManagementInterface->listManagements(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('libranza::admin.categories.list', $response['data']);
    }

    public function create()
    {
        return view('libranza::admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'src' => 'required|file|image:png,jpeg,jpg,gif'
        ]);

        $this->bannerManagementInterface->saveManagement(['data' => $request->except('_token', '_method', 'src'), 'image' => $request->file('src')]);

        return redirect()->route('admin.bannerManagement.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return view('libranza::admin.categories.show', [
            'category' => $this->bannerManagementInterface->showManagement($id)
        ]);
    }

    public function edit($id)
    {
        return view('libranza::admin.categories.edit', [
            'category' => $this->bannerManagementInterface->showManagement($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = [
            'data'  => $request->input(),
            'id'    => $id,
            'image' => $request->file('src')
        ];

        $this->bannerManagementInterface->updateManagement($data);

        return redirect()->route('admin.bannerManagement.edit', $id)
            ->with('message', 'Actualizado correctamente');
    }


    public function updateSortOrder(Request $request, int $id)
    {
        $res = $this->bannerManagementInterface->updateSortOrder($request->json());
        return $res;
    }
}
