<?php

namespace Modules\Ecommerce\Entities\ProductAttributes\Repositories;

use Modules\Ecommerce\Entities\ProductAttributes\Exceptions\ProductAttributeNotFoundException;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductAttributeRepository implements ProductAttributeRepositoryInterface
{
    protected $model;
    private $columns = [];

    public function __construct(ProductAttribute $productAttribute)
    {
        $this->model = $productAttribute;
    }

    public function findProductAttributeById(int $id)
    {
        try {
            return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductAttributeNotFoundException($e);
        }
    }
}
