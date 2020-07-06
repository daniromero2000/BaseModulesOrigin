<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Attributes;

use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepository;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\Requests\CreateAttributeValueRequest;

class AttributeValueController extends Controller
{
    private $attributeRepo, $attributeValueRepo;

    public function __construct(
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository
    ) {
        $this->attributeRepo      = $attributeRepository;
        $this->attributeValueRepo = $attributeValueRepository;
        $this->middleware(['permission:attributes, guard:employee']);
    }

    public function create($id)
    {
        return view('ecommerce::admin.attribute-values.create', [
            'attribute' => $this->attributeRepo->findAttributeById($id)
        ]);
    }

    public function store(CreateAttributeValueRequest $request, $id)
    {
        $attribute = $this->attributeRepo->findAttributeById($id);
        $attributeValue = new AttributeValue($request->except('_token'));
        $attributeValueRepo = new AttributeValueRepository($attributeValue);
        $attributeValueRepo->associateToAttribute($attribute);
        $request->session()->flash('message', config('messaging.create'));

        return redirect()->route('admin.attributes.show', $attribute->id);
    }

    public function destroy($attributeId, $attributeValueId)
    {
        $attributeValue = $this->attributeValueRepo->findOrFail($attributeValueId);
        $attributeValueRepo = new AttributeValueRepository($attributeValue);
        $attributeValueRepo->dissociateFromAttribute();

        request()->session()->flash('message', config('messaging.delete'));
        return redirect()->route('admin.attributes.show', $attributeId);
    }
}
