<?php

namespace Modules\CallCenter\Http\Controllers\Admin\Questionnaires;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CallCenter\Entities\Questionnaires\Services\Interfaces\CallCenterQuestionnaireServiceInterface;

class QuestionnaireController extends Controller
{
    private $callCenterQuestionnaireInterface;

    public function __construct(
        CallCenterQuestionnaireServiceInterface $callCenterQuestionnaireServiceInterface
    ) {
        $this->callCenterQuestionnaireInterface   = $callCenterQuestionnaireServiceInterface;
    }

    public function index(Request $request)
    {
        $response = $this->callCenterQuestionnaireInterface->listQuestionnaires(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('callcenter::admin.questionnaires.list', $response['data']);
    }

    public function create()
    {
        return view('callcenter::admin.questionnaires.create');
    }

    public function store(Request $request)
    {
        $this->callCenterQuestionnaireInterface->saveQuestionnaire($request->except('_token', '_method'));
        return response()->json(true);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return view('callcenter::admin.questionnaires.edit');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');

        $this->callCenterQuestionnaireInterface->updateQuestionnaire(['data' => $data, 'id' => $id]);

        return redirect()->route('admin.questionnaires.index')->with('message', 'Actualización Exitosa');
    }

    public function destroy($id)
    {
        //
    }
}
