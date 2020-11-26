<?php

namespace Modules\Companies\Http\Controllers\Admin\Companies;

use Modules\Companies\Entities\Companies\Repositories\CompanyRepository;
use Modules\Companies\Entities\Companies\Repositories\Interfaces\CompanyRepositoryInterface;
use Modules\Companies\Entities\Companies\Requests\CreateCompanyRequest;
use Modules\Companies\Entities\Companies\Requests\UpdateCompanyRequest;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private $toolsInterface, $companyInterface, $countryInterface;

    public function __construct(
        ToolRepositoryInterface $toolRepositoryInterface,
        CompanyRepositoryInterface $companyRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface
    ) {
        $this->toolsInterface   = $toolRepositoryInterface;
        $this->companyInterface = $companyRepositoryInterface;
        $this->countryInterface = $countryRepositoryInterface;
    }

    public function index(Request $request)
    {
        if (request()->has('q')) {
            $list = $this->companyInterface->searchCompany(request()->input('q'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } elseif (request()->has('t')) {
            $list = $this->companyInterface->searchTrashedCompany(request()->input('t'));
            $request->session()->flash('message', 'Resultado de la Busqueda');
        } else {
            $skip = $this->toolsInterface->getSkip($request->input('skip'));
            $list = $this->companyInterface->listCompanies($skip * 30);
        }

        return view('companies::admin.companies.list', [
            'companies'     => $list,
            'skip'          => $skip,
            'countries'     => $this->countryInterface->listCountries(),
            'optionsRoutes' => 'admin.' . (request()->segment(2)),
            'headers'       => ['ID', 'Nombre', 'Identificación', 'Logo', 'Estado', 'Opciones'],
        ]);
    }

    public function create()
    {
        return view('companies::admin.companies.create', [
            'countries' => $this->countryInterface->listCountries(),
        ]);
    }

    public function store(CreateCompanyRequest $request)
    {
        $this->companyInterface->createCompany($request->except('_token', '_method'));

        return redirect()->route('admin.companies.index')
            ->with('message', 'Compañia Creada Exitosamente!');
    }

    public function edit(int $id)
    {
        return redirect()->route('admin.companies.index');
    }

    public function update(UpdateCompanyRequest $request, $id)
    {
        $update = new CompanyRepository($this->companyInterface->findCompanyById($id));
        $update->updateCompany($request->except('_token', '_method'));
        $request->session()->flash('message', 'Actualizacion Exitosa');

        return redirect()->route('admin.companies.index');
    }

    public function getDepartments(Request $request, $id)
    {
        $company = $this->companyInterface->findCompanyById($id);

        return $company->deparments;
    }

    public function destroy(int $id)
    {
        $company = new CompanyRepository($this->companyInterface->findCompanyById($id));
        $company->deleteCompany();

        request()->session()->flash('message', 'Eliminado Satisfactoriamente');

        return redirect()->route('admin.companies.index');
    }
}
