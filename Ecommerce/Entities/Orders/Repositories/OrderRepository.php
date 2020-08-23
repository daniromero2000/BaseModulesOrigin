<?php

namespace Modules\Ecommerce\Entities\Orders\Repositories;

use Modules\Ecommerce\Entities\Carts\Repositories\CartRepository;
use Modules\Ecommerce\Entities\Carts\ShoppingCart;
use Modules\Ecommerce\Entities\Shoppingcart\Facades\Cart;
use Modules\Companies\Entities\Employees\Employee;
use Modules\Companies\Entities\Employees\Repositories\EmployeeRepository;
use Modules\Ecommerce\Events\OrderCreateEvent;
use Modules\Ecommerce\Mail\sendEmailNotificationToAdminMailable;
use Modules\Ecommerce\Mail\sendOrderToCustomerMailable;
use Modules\Ecommerce\Entities\Orders\Exceptions\OrderInvalidArgumentException;
use Modules\Ecommerce\Entities\Orders\Exceptions\OrderNotFoundException;
use Modules\Ecommerce\Entities\Addresses\Address;
use Modules\Ecommerce\Entities\Couriers\Courier;
use Modules\Ecommerce\Entities\Orders\Order;
use Modules\Ecommerce\Entities\Orders\Repositories\Interfaces\OrderRepositoryInterface;
use Modules\Ecommerce\Entities\Orders\Transformers\OrderTransformable;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class OrderRepository implements OrderRepositoryInterface
{
    use OrderTransformable;
    protected $model;
    private $columns = ['id', 'reference', 'courier_id', 'customer_id', 'address_id', 'order_status_id', 'payment', 'discounts', 'total_shipping', 'sub_total', 'tax_amount', 'grand_total', 'created_at', 'total_paid'];

    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function createOrder(array $params): Order
    {
        try {
            $order = $this->model->create($params);
            $orderRepo = new OrderRepository($order);
            $orderRepo->buildOrderDetails(Cart::content());
            // event(new OrderCreateEvent($order));

            return $order;
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function createPayUOrder(array $params): Order
    {
        try {
            return  $this->model->create($params);
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage(), 500, $e);
        }
    }

    public function updateOrder(array $params): bool
    {
        try {
            return $this->model->update($params);
        } catch (QueryException $e) {
            throw new OrderInvalidArgumentException($e->getMessage());
        }
    }

    public function findOrderById(int $id): Order
    {
        try {
            return $this->model->with(['orderPayments'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e);
        }
    }

    public function listOrders(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->model->with('orderStatus')->orderBy('id', 'desc')
            ->get($this->columns);
    }

    public function findProducts(Order $order): Collection
    {
        return $order->products;
    }

    public function associateProduct(Product $product, int $quantity = 1, array $data = [])
    {
        $this->model->products()->attach($product, [
            'quantity' => $quantity,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'product_description' => $product->description,
            'product_price' => $product->price,
            'product_attribute_id' => isset($data['product_attribute_id']) ? $data['product_attribute_id'] : null,
        ]);
        $product->quantity = ($product->quantity - $quantity);
        $product->save();
    }

    public function sendEmailToCustomer()
    {
        Mail::to($this->model->customer)
            ->send(new SendOrderToCustomerMailable($this->findOrderById($this->model->id)));
    }

    public function sendEmailNotificationToAdmin()
    {
        $employeeRepo = new EmployeeRepository(new Employee);
        $employee = $employeeRepo->findEmployeeById(1);

        Mail::to($employee)
            ->send(new sendEmailNotificationToAdminMailable($this->findOrderById($this->model->id)));
    }

    public function searchOrder(string $text): Collection
    {
        if (!empty($text)) {
            return $this->model->searchForOrder($text)->get();
        } else {
            return $this->listOrders();
        }
    }

    public function transform()
    {
        return $this->transformOrder($this->model);
    }

    public function listOrderedProducts(): Collection
    {
        return $this->model->products->map(function (Product $product) {
            $product->name = $product->pivot->product_name;
            $product->sku = $product->pivot->product_sku;
            $product->description = $product->pivot->product_description;
            $product->price = $product->pivot->product_price;
            $product->quantity = $product->pivot->quantity;
            $product->weight = $product->weight;
            $product->product_attribute_id = $product->pivot->product_attribute_id;
            return $product;
        });
    }

    public function buildOrderDetails(Collection $items)
    {
        $items->each(function ($item) {
            $productRepo = new ProductRepository(new Product);
            $product = $productRepo->find($item->id);
            if ($item->options->has('product_attribute_id')) {
                $this->associateProduct($product, $item->qty, [
                    'product_attribute_id' => $item->options->product_attribute_id,
                ]);
            } else {
                $this->associateProduct($product, $item->qty);
            }
        });
    }

    public function getAddresses(): Collection
    {
        return $this->model->address()->get();
    }

    public function getCouriers(): Collection
    {
        return $this->model->courier()->get();
    }

    public function removeOrder(): bool
    {
        try {
            return $this->model->where('id', $this->model->id)->delete();
        } catch (QueryException $e) {
            dd($e);
        }
    }

    public function findOrderShippings($id): Collection
    {
        try {
            return $this->model->with(['order_id'])
                ->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new OrderNotFoundException($e);
        }
    }
}
