<?php

namespace Modules\Ecommerce\Entities\Attributes\Repositories;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Support\Collection;

interface AttributeRepositoryInterface
{
    public function createAttribute(array $data): Attribute;

    public function findAttributeById(int $id): Attribute;

    public function updateAttribute(array $data): bool;

    public function deleteAttribute(): ?bool;

    public function listAttributes(string $orderBy = 'id', string $sortBy = 'asc'): Collection;

    public function listAttributeValues(): Collection;

    public function associateAttributeValue(AttributeValue $attributeValue): AttributeValue;
}
