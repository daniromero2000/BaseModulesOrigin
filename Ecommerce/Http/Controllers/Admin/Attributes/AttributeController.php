<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Attributes;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Attributes\Exceptions\AttributeNotFoundException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\UpdateAttributeErrorException;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepository;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\Requests\CreateAttributeRequest;
use Modules\Ecommerce\Entities\Attributes\Requests\UpdateAttributeRequest;

class AttributeController extends Controller
{
    private $attributeRepo;

    public function __construct(
        AttributeRepositoryInterface $attributeRepository
    ) {
        $this->attributeRepo = $attributeRepository;
        $this->middleware(['permission:attributes, guard:employee']);
    }

    public function index()
    {
        return view('ecommerce::admin.attributes.list', [
            'attributes' => $this->attributeRepo->list(),
            'optionsRoutes'   => 'admin.' . (request()->segment(2)),
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.attributes.create');
    }

    public function store(CreateAttributeRequest $request)
    {
        $this->attributeRepo->createAttribute($request->except('_token'));
        $request->session()->flash('message', config('messaging.create'));
        return redirect()->back();
    }

    public function show($id)
    {
        try {
            $attribute = $this->attributeRepo->findAttributeById($id);
            $attributeRepo = new AttributeRepository($attribute);

            return view('ecommerce::admin.attributes.show', [
                'attribute' => $attribute,
                'values'    => $attributeRepo->listAttributeValues()
            ]);
        } catch (AttributeNotFoundException $e) {
            request()->session()->flash('error', 'El atributo que estás buscando no se encuentra');

            return redirect()->route('admin.attributes.index');
        }
    }

    public function edit($id)
    {
        return view('ecommerce::admin.attributes.edit', [
            'attribute' =>  $this->attributeRepo->findAttributeById($id)
        ]);
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        try {
            $attribute = $this->attributeRepo->findAttributeById($id);
            $attributeRepo = new AttributeRepository($attribute);
            $attributeRepo->updateAttribute($request->except('_token'));
            $request->session()->flash('message', config('messaging.update'));

            return redirect()->back();
        } catch (UpdateAttributeErrorException $e) {
            $request->session()->flash('error', $e->getMessage());

            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        $this->attributeRepo->findAttributeById($id)->delete();
        request()->session()->flash('message', config('messaging.delete'));

        return redirect()->back();
    }
}
