<?php

namespace Modules\Ecommerce\Entities\Attributes\Repositories;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\Attributes\Exceptions\AttributeNotFoundException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\CreateAttributeErrorException;
use Modules\Ecommerce\Entities\Attributes\Exceptions\UpdateAttributeErrorException;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class AttributeRepository implements AttributeRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'name',
        'is_active'
    ];

    public function __construct(Attribute $attribute)
    {
        $this->model = $attribute;
    }

    public function createAttribute(array $data): Attribute
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateAttributeErrorException($e);
        }
    }

    public function findAttributeById(int $id): Attribute
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new AttributeNotFoundException($e);
        }
    }

    public function updateAttribute(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateAttributeErrorException($e);
        }
    }

    public function deleteAttribute(): ?bool
    {
        return $this->model->delete();
    }

    public function list(string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        try {
            return $this->model
                ->get($this->columns, $orderBy, $sortBy);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listAttributes(string $orderBy = 'id', string $sortBy = 'asc'): Collection
    {
        try {
            return $this->model
                ->where('is_active', 1)
                ->get($this->columns, $orderBy, $sortBy);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listCategoryAttributes($select): Collection
    {
        try {
            return $this->model->with(array('values' => function ($query) use ($select) {
                $query->whereIn('id', $select);
            }))->get($this->columns);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function listAttributeValues(): Collection
    {
        return $this->model->values()->orderby('value')->get();
    }

    public function associateAttributeValue(AttributeValue $attributeValue): AttributeValue
    {
        return $this->model->values()->save($attributeValue);
    }
}
