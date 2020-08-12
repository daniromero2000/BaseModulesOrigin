<?php

namespace Modules\Ecommerce\Entities\OrderShippingItems\Repositories\Interfaces;

use Illuminate\Support\Collection;

use Modules\Ecommerce\Entities\OrderShippingItems\OrderShippingItem;

interface OrderShippingItemInterface
{
    public function createOrderShippingItem(array $data): OrderShippingItem;
    public function listOrderShippingItems(): Collection;

}
