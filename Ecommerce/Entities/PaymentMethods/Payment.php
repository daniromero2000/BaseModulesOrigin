<?php

namespace Modules\Ecommerce\Entities\PaymentMethods;

class Payment
{
    protected $payment;

    public function __construct($class)
    {
        $this->payment = $class;
    }

    public function init()
    {
        return $this->payment;
    }
}
