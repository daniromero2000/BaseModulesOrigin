<?php

namespace Modules\Ecommerce\Listeners;

use Modules\Customers\Events\OrderCreateEvent;
use Modules\Ecommerce\Entities\Orders\Repositories\OrderRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderCreateEventListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    public function handle(OrderCreateEvent $event)
    {
        // send email to customer
        $orderRepo = new OrderRepository($event->order);
        $orderRepo->sendEmailToCustomer();

        $orderRepo = new OrderRepository($event->order);
        $orderRepo->sendEmailNotificationToAdmin();
    }
}
