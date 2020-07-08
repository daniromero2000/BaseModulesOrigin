<?php

namespace Modules\Ecommerce\Entities\Checkout;

use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\Ecommerce\Entities\Checkout\Checkout;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;

class CheckoutRepository
{
    protected $model;

    public function __construct(Checkout $checkout)
    {
        $this->model = $checkout;
    }

    public function createCheckout($data)
    {
        try {
            $checkout = $this->model->create($data);
            $checkoutRepo = new CheckoutRepository($checkout);
            $checkoutRepo->buildCheckoutDetails(Cart::content());
            return $checkout;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function associateProduct(Product $product, int $quantity = 1, array $data = [])
    {
        try {
            $this->model->products()->attach($product, [
                'quantity' => $quantity,
                'product_name' => $product->name,
                'product_sku' => $product->sku,
                'product_price' => $product->price,
                'product_attribute_id' => isset($data['product_attribute_id']) ? $data['product_attribute_id'] : null,
            ]);
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function getLastCheckout(): Checkout
    {
        try {
            return  $this->model->get()->last();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function deleteCheckout(): bool
    {
        try {
            $this->model->products()->detach();
            return $this->model->where('id', $this->model->id)->delete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
        return true;
    }

    public function removeCheckout($checkout): bool
    {
        try {
            $this->model->products()->detach();
            return $this->model->where('id', $checkout->id)->forceDelete();
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
    }

    public function buildCheckoutDetails(Collection $items)
    {
        $items->each(function ($item) {
            $productRepo = new ProductRepository(new Product);
            $product = $productRepo->find($item->id);
            if ($item->options->has('product_attribute_id')) {
                $this->associateProduct($product, $item->qty, [
                    'product_attribute_id' => $item->options->product_attribute_id
                ]);
            } else {
                $this->associateProduct($product, $item->qty);
            }
        });
    }

    public function buildCheckoutItems(array $data): Order
    {
        $orderRepo = new OrderRepository(new Order);
        $order = $orderRepo->createOrder([
            'reference' => $data['reference'],
            'courier_id' => $data['courier_id'],
            'customer_id' => $data['customer_id'],
            'address_id' => $data['address_id'],
            'order_status_id' => $data['order_status_id'],
            'payment' => $data['payment'],
            'discounts' => $data['discounts'],
            'sub_total' => $data['sub_total'],
            'grand_total' => $data['grand_total'],
            'total_paid' => $data['total_paid'],
            'total_shipping' => isset($data['total_shipping']) ? $data['total_shipping'] : 0,
            'tax_amount' => $data['tax']
        ]);

        return $order;
    }
}
