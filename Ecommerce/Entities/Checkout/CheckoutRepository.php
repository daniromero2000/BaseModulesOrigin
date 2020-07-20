<?php

namespace Modules\Ecommerce\Entities\Checkout;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    protected $columns = ['id', 'customer_id', 'created_at'];

    public function __construct(Checkout $checkout)
    {
        $this->model = $checkout;
    }

    public function updateOrCreateCheckout($data)
    {
        try {
            $checkout = $this->model->updateOrCreate(
                ['customer_id' => $data['customer_id']],
                [$data]
            );
        } catch (QueryException $e) {
            dd($e);
        }

        $checkoutRepo = new CheckoutRepository($checkout);
        $checkoutRepo->buildCheckoutDetails(Cart::content());
        return true;
    }

    public function listCheckouts(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->with('products')
            ->get($this->columns);
    }

    public function findCheckoutById(int $id): Checkout
    {
        try {
            return $this->model->with(['products', 'customer'])->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e);
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
        } catch (QueryException $e) {
            abort(503, $e->getMessage());
        }
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

    public function buildPayUCheckoutItems(array $data): Order
    {
        $orderRepo = new OrderRepository(new Order);
        $order = $orderRepo->createPayUOrder([
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

    public function getCreditCards($array)
    {
        $cards = [];
        $temp = [];
        foreach ($array as $key => $value) {
            if ($value->description == 'VISA' || $value->description == 'MASTERCARD' || $value->description == 'DINERS') {
                if (!in_array($value->description, $temp)) {
                    $temp[] = $value->description;
                    if ($value->description == 'VISA') {
                        $value->icon = 'img/cards/visa.png';
                    }
                    if ($value->description == 'MASTERCARD') {
                        $value->icon = 'img/cards/mastercard.png';
                    }
                    if ($value->description == 'DINERS') {
                        $value->icon = 'img/cards/diners.png';
                    }
                    array_push($cards, $value);
                }
            }
        }

        return $cards;
    }

    public function getBalotoEfecty($array)
    {
        $getBalotoEfecty = [];
        foreach ($array as $key => $value) {
            if ($value->description == 'BALOTO' || $value->description == 'EFECTY') {
                if ($value->description == 'BALOTO') {
                    $value->icon = 'img/cards/baloto.png';
                }
                if ($value->description == 'EFECTY') {
                    $value->icon = 'img/cards/efecty.png';
                }
                array_push($getBalotoEfecty, $value);
            }
        }
        return $getBalotoEfecty;
    }

    public function getPse($array)
    {
        foreach ($array as $key => $value) {
            if (($value->description) == 'PSE') {
                $array = $value;
            }
        }
        return $array;
    }
}
