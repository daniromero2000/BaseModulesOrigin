<?php

namespace Modules\DocumentManagement\Http\Controllers\Admin\Document;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
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
        $this->middleware(['permission:documents, guard:employee']);
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->documentInterface->searchDocument(request()->input('q'), $skip * 30);
            $paginate = $this->documentInterface->countDocuments(request()->input('q'), '');
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->documentInterface->searchDocument(request()->input('q'), $skip * 30, $from, $to);
            $paginate = $this->documentInterface->countDocuments(request()->input('q'), $from, $to);
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $paginate = $this->documentInterface->countDocuments('');
            $list = $this->documentInterface->listDocuments($skip * 30);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

      ;

        return view('documentmanagement::admin.documents.index', [
            'documents'       => $list,
            'skip'            => $skip,
            'headers'         => ['Nombre',  'Estado', 'Categorias', 'Fecha', 'Opciones'],
            'routeEdit'       => 'admin.documents.update',
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
            'title'           => 'Documentos',
            'attached'        => $attached,
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Documento', 'type' => 'file', 'name' => 'src'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name'],
                ['title' => 'Categorias', 'label' => 'name', 'type' => 'checkbox', 'array' => $this->documentCategoryInterface->findDocumentCategoriesForCompany(auth()->guard('employee')->user()->company_id), 'name' => 'categories[]']
            ],
            'searchInputs'       => [['label' => 'Buscar', 'type' => 'text', 'name' => 'q'], ['label' => 'Desde', 'type' => 'date', 'name' => 'from'], ['label' => 'Hasta', 'type' => 'date', 'name' => 'to']],
            'paginate'        => $getPaginate['paginate'],
            'position'        => $getPaginate['position'],
            'page'            => $getPaginate['page'],
            'limit'           => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('documentmanagement::admin.documents.create', [
            'categories' => $this->documentCategoryInterface->findDocumentCategoriesForCompany(auth()->guard('employee')->user()->company_id)
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {
            $data['src'] = $this->documentInterface->saveDocumentFile($request->file('src'));
        }

        $data['slug'] = str_slug($request->input('name'));
        $this->documentInterface->createDocument(['data' => $data, 'categories' => $request->input('categories')]);

        return redirect()->route('admin.documents.index')->with('message', 'Creación Exitosa');
    }

    public function show($id)
    {
        $data = $this->documentInterface->findDocumentById($id);
        $attached = [];

        $attached[$data->id] = $data->categoryLog->pluck('document  _category_id')->all();

        return view('documentmanagement::admin.documents.show', [
            'breadcrumb' => [
                ['route' => 'admin.documents.index', 'status' => '', 'name' => 'Indicadores'],
                ['route' => '', 'status' => 'active', 'name' => $data->name]
            ],
            'inputs' => [
                ['label' => 'Nombres', 'type' => 'text', 'name' => 'name'],
                ['label' => 'Estado', 'type' => 'select', 'name' => 'is_active', 'options' => [['id' => 1, 'name' => 'Activo'], ['id' => '0', 'name' => 'Inactivo']], 'option' => 'name'],
                ['title' => 'Categorias', 'label' => 'name', 'type' => 'checkbox', 'array' => $this->documentCategoryInterface->findDocumentCategoriesForCompany(auth()->guard('employee')->user()->company_id), 'name' => 'categories[]']
            ],
            'attached'   => $attached,
            'document'   => $data
        ]);
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');

        if ($request->hasFile('src') && $request->file('src') instanceof UploadedFile) {
            $data['src'] = $this->documentInterface->saveDocumentFile($request->file('src'));
        }
        $data['slug'] = str_slug($request->input('name'));
        $finance      = $this->documentInterface->updateDocument(['data' => $data, 'categories' => $request->input('categories'), 'id' => $id]);

        return redirect()->route('admin.documents.index')->with('message', 'Actualización  Exitosa');
    }

    public function destroy($id)
    {
        $document = $this->documentInterface->findDocumentById($id);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('message', 'Se ha eliminado correctamente');
    }
}
