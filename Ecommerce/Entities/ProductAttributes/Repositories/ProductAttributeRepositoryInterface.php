<?php

namespace Modules\Ecommerce\Entities\ProductAttributes\Repositories;

interface ProductAttributeRepositoryInterface
{
    public function findProductAttributeById(int $id);
}
