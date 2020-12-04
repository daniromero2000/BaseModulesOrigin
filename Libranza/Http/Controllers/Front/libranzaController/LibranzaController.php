<?php

namespace Modules\Libranza\Http\Controllers\Front\libranzaController;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\LeadProductRepository;

class LibranzaController extends Controller
{

    private $cityInterface;

    public function __construct(
        CityRepositoryInterface $cityRepositoryInterface,
        LeadInformationRepositoryInterface $LeadInformationRepositoryInterface,
        LeadRepositoryInterface $LeadRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface
    ) {
        $this->cityInterface             = $cityRepositoryInterface;
        $this->leadInterface             = $LeadRepositoryInterface;
        $this->leadInformationInterface  = $LeadInformationRepositoryInterface;
        $this->leadProductInterface      = $leadProductRepositoryInterface;
    }

    public function subForm()
    {
        if (request()->input()) {
            $leadProduct = $this->leadProductInterface->findProductForName(request()->input('linea'));
            try {
                if (!$leadProduct) {
                    $data = [
                        'product' => request()->input('linea'),
                        'is_active' => '1'
                    ];

                    $leadProduct = $this->leadProductInterface->createLeadProduct($data);
                    $productRepo = new LeadProductRepository($this->leadProductInterface->findProductForName(request()->input('linea')));
                    $productRepo->syncDeparments(['17']);
                }
            } catch (\Throwable $th) {
            }
        }
        $amounts = [];
        $price = 0;
        for ($i=0; $i < 80; $i++) {
            $price = $price + 1000000;
            $amounts[] = $price;
        }

        $products = $this->leadProductInterface->getProductsForDepartment('17');
        $amountOrigin =  round(request()->input('monto'), -5, PHP_ROUND_HALF_UP);

        return view('libranza.front.form_libranza', [
            'cities'       => $this->cityInterface->listCitiesFront(),
            'products'     => $products,
            'amounts'      => $amounts,
            'amountOrigin' => $amountOrigin
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

    public function create()
    {
        return view('libranza::create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'department_id' => 17,
            'lead_service_id' => 12,
            'lead_product_id' => $request->input('lead_product_id') ? $request->input('lead_product_id') : 44,
            'lead_channel_id' => 1
        ]);

        $lead = $this->leadInterface->createLead($request->except('_token', 'emailConfirm', 'kind_of_person', 'amount', 'term', 'entity'));
        $request->merge(['lead_id' => $lead->id]);
        $lead->leadStatus()->attach($request->input('lead_status_id'));
        $this->leadInformationInterface->createLeadInformation($request->only('lead_id',  'kind_of_person', 'amount', 'term', 'entity'));

        return redirect()->route('thank.you.page');
    }

    public function show($id)
    {
        return view('libranza::show');
    }

    public function edit($id)
    {
        return view('libranza::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
