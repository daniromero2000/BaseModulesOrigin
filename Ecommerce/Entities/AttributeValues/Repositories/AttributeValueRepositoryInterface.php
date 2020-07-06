<?php

namespace Modules\Ecommerce\Entities\AttributeValues\Repositories;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeValueRepositoryInterface
{
    public function createAttributeValue(Attribute $attribute, array $data): AttributeValue;

    public function associateToAttribute(Attribute $attribute): AttributeValue;

    public function dissociateFromAttribute(): bool;

    public function findProductAttributes(): Collection;

    public function find($id);
}
