<?php

namespace Modules\Libranza\Http\Controllers\Api\libranzaController;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Logs\Repositories\Interfaces\LogRepositoryInterface;
use Modules\Leads\Entities\Leads\Repositories\Interfaces\LeadRepositoryInterface;
use Modules\Leads\Entities\LeadInformations\Repositories\Interfaces\LeadInformationRepositoryInterface;
use Modules\Leads\Entities\LeadProducts\Repositories\Interfaces\LeadProductRepositoryInterface;

class LibranzaController extends Controller
{

    private $cityInterface;

    public function __construct(
        CityRepositoryInterface $cityRepositoryInterface,
        LeadInformationRepositoryInterface $LeadInformationRepositoryInterface,
        LeadRepositoryInterface $LeadRepositoryInterface,
        LeadProductRepositoryInterface $leadProductRepositoryInterface,
        LogRepositoryInterface $logRepositoryInterface
    ) {
        $this->cityInterface             = $cityRepositoryInterface;
        $this->leadInterface             = $LeadRepositoryInterface;
        $this->leadInformationInterface  = $LeadInformationRepositoryInterface;
        $this->leadProductInterface      = $leadProductRepositoryInterface;
        $this->logInterface              = $logRepositoryInterface;
    }

    public function store(Request $request)
    {
        $user = auth()->guard('api')->user();
        $data = $request->input();

        if (!$user) {
            $this->logInterface->createLog(['data' => json_encode($data), 'response' => json_encode(['message' => 'unauthenticated']), 'origin' => 'Leads']);
            return response()->json([
                'message' => 'unauthenticated'
            ]);
        }


        $validation = Validator::make($request->all(), [
            'name'                  => 'bail|required|string|max:191',
            'last_name'             => 'bail|required|string|max:191',
            'identification_number' => 'bail|required|string|max:11',
            'telephone'             => 'bail|required|string|max:10',
            'city'                  => 'bail|required|integer',
            'email'                 => 'bail|required|email:rfc,dns|max:191',
            'kind_of_person'        => 'bail|required|string|max:191',
            'amount'                => 'bail|required|integer',
            'term'                  => 'bail|required|integer',
            'entity'                => 'bail|required|string|max:191',
            'product_line'          => 'bail|required|string|max:191'
        ]);

        $errors = $validation->errors();
        if (!empty($errors->toArray())) {
            $response = ["response" => [
                "status"           => "ERROR",
                "statusCode"       => 500,
                "message"          => 'Ocurrio un error al intentar guardar los datos',
                "data"             => $data,
                "errors"           => $errors
            ]];
            $this->logInterface->createLog(['data' => json_encode($data), 'response' => json_encode($response), 'origin' => 'Leads']);
            return response()->json($response);
        }

        try {

            $city = $this->cityInterface->findCityByCode($data['city']);

            if (empty($city)) {
                $response = ["response" => [
                    "status"           => "ERROR",
                    "statusCode"       => 404,
                    "message"          => 'Ocurrio un error al intentar guardar los datos',
                    "data"             => $data,
                    "errors"           => ['error' => 'no se ha encontrado ninguna ciudad con el código enviado']
                ]];
                $this->logInterface->createLog(['data' => json_encode($data), 'response' => json_encode($response), 'origin' => 'Leads']);
                return response()->json($response);
            }

            $leadProduct = $this->leadProductInterface->findProductForName($data['product_line']);

            if (empty($leadProduct)) {
                $data = [
                    'product' => $data['product_line'],
                    'is_active' => '1'
                ];

                $leadProduct = $this->leadProductInterface->createLeadProduct($data);
                $leadProduct->departments()->sync(['17']);
            }

            $data['city_id'] = $city->id;

            $data = array_merge($data, [
                'department_id' => 17,
                'lead_service_id' => 12,
                'lead_product_id' =>  $leadProduct->id,
                'lead_channel_id' => 1
            ]);

            $lead = $this->leadInterface->createLead($data);
            $data['lead_id'] = $lead->id;
            $this->leadInformationInterface->createLeadInformation($data);

            unset($data['department_id']);
            unset($data['lead_service_id']);
            unset($data['lead_product_id']);
            unset($data['lead_channel_id']);
            unset($data['city_id']);
            unset($data['lead_id']);

            $response = ["response" => [
                "status"           => "OK",
                "statusCode"       => 200,
                "message"          => 'Registro exitoso',
                "data"             => $data,
                "errors"           => []
            ]];

            return response()->json($response);
        } catch (\Throwable $th) {
            $response = ["response" => [
                "status"           => "ERROR",
                "statusCode"       => 500,
                "message"          => 'Ocurrio un error al intentar guardar los datos',
                "data"             => $data,
                "errors"           => $th->getMessage()
            ]];

            $this->logInterface->createLog(['data' => json_encode($data), 'response' => json_encode($response), 'origin' => 'Leads']);

            return response()->json($response);
        }
    }
}
