<?php

namespace App\Http\Controllers\Front\Pqrs;

use App\Http\Controllers\Controller;
use Modules\Pqrs\Entities\Pqrs\Repositories\Interfaces\PqrRepositoryInterface;
use Modules\Pqrs\Entities\Pqrs\Requests\CreatePqrRequest;
use Modules\Pqrs\Entities\PqrStatuses\Repositories\Interfaces\PqrStatusRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Cities\City;

class PqrController extends Controller
{
    private $pqrStatusRepo;

    public function __construct(
        PqrRepositoryInterface $pqrRepository,
        PqrStatusRepositoryInterface $pqrStatusRepository,
        CityRepositoryInterface $cityRepository
    ) {
        $this->pqrRepo       = $pqrRepository;
        $this->pqrStatusRepo = $pqrStatusRepository;
        $this->cityRepo      = $cityRepository;
        $this->middleware(['permission:pqrs, guard:customers']);
    }

    public function index()
    {
    }

    public function create()
    {
        return view('front.pqrs.create', [
            'statuses' => $this->pqrStatusRepo->listPqrStatuses(),
            'cities'   => City::all()
        ]);
    }

    public function store()
    {
    }

    public function show()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
    }

    public function destroy()
    {
    }
}
