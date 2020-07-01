<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Repositories;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Support\Collection;

class AttributeValueRepository implements AttributeValueRepositoryInterface
{
    protected $model;

    public function __construct(AttributeValue $attributeValue)
    {
        $this->model = $attributeValue;
    }

    public function createAttributeValue(Attribute $attribute, array $data): AttributeValue
    {
        $attributeValue = new AttributeValue($data);
        $attributeValue->attribute()->associate($attribute);
        $attributeValue->save();
        return $attributeValue;
    }

    public function associateToAttribute(Attribute $attribute): AttributeValue
    {
        $this->model->attribute()->associate($attribute);
        $this->model->save();
        return $this->model;
    }

    public function dissociateFromAttribute(): bool
    {
        return $this->model->delete();
    }

    public function findProductAttributes(): Collection
    {
        return $this->model->productAttributes()->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }
}
