<?php

namespace Modules\DocumentManagement\Http\Controllers\Front\Document;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Routing\Controller;
use Modules\DocumentManagement\Entities\Documents\Repositories\Interfaces\DocumentRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\DocumentManagement\Entities\DocumentCategories\Repositories\Interfaces\DocumentCategoryRepositoryInterface;

class DocumentController extends Controller
{
    private $documentInterface, $toolsInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        DocumentRepositoryInterface $documentRepositoryInterface,
        DocumentCategoryRepositoryInterface $documentCategoryRepositoryInterface
    ) {
        $this->toolsInterface                  = $toolRepositoryInterface;
        $this->documentInterface               = $documentRepositoryInterface;
        $this->documentCategoryInterface       = $documentCategoryRepositoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->input()) {
            $data = $this->documentInterface->findDocumentById(request()->input('id'));
            $file = "storage/" . $data->src;
            $headers = array(
                'Content-Type: application/pdf',
            );
            $data->downloads = $data->downloads + 1;
            $data->update();
            return Response::download($file, $data->name . '.pdf', $headers);
        }



        $data = $this->documentCategoryInterface->findDocumentCategoriesForCompany(1);

        $categories = [];
        foreach ($data as $key => $item) {
            $categories[$item->name] =  $item->documents;
        }

        return view('libranza.front.information.finances', [
            'categories' => $categories,
            'active'     => '2020'
        ]);
    }

    public function show($id)
    {
        redirect()->route('indicadores.index');
    }
}
