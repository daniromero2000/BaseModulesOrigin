<?php

namespace Modules\Ecommerce\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Repositories\CategoryRepository;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepository;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepository;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Repositories\BrandRepository;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\OrderStatusRepository;
use Modules\Ecommerce\Entities\OrderStatuses\Repositories\Interfaces\OrderStatusRepositoryInterface;
use Modules\Ecommerce\Entities\Carts\Repositories\CartRepository;
use Modules\Ecommerce\Entities\Carts\Repositories\Interfaces\CartRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepository;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Shipping\Repositories\Interfaces\ShippingRepositoryInterface;
use Modules\Ecommerce\Entities\Shipping\Repositories\ShippoShipmentRepository;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\ProductGroupRepository;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces\ProductGroupRepositoryInterface;


class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            ProductGroupRepositoryInterface::class,
            ProductGroupRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            AttributeRepositoryInterface::class,
            AttributeRepository::class
        );

        $this->app->bind(
            AttributeValueRepositoryInterface::class,
            AttributeValueRepository::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->bind(
            CourierRepositoryInterface::class,
            CourierRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            OrderStatusRepositoryInterface::class,
            OrderStatusRepository::class
        );

        $this->app->bind(
            CartRepositoryInterface::class,
            CartRepository::class
        );

        $this->app->bind(
            ProductAttributeRepositoryInterface::class,
            ProductAttributeRepository::class
        );

        $this->app->bind(
            ShippingRepositoryInterface::class,
            ShippoShipmentRepository::class
        );
    }
}
