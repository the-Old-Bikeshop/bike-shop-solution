<?php

class CheckoutController
{

    private $order;
    private $address;
    private $user;

    public function __construct()
    {
        $this->order = new OrderController();
        $this->address = new AddressController();
        $this->user  =new UserController();

    }

//    create anonimus user

//    check, create or update address

//    create order -- make sure to include total price from basket and set the order and payment status

//    add products to order

//    send confirmation email to user



}