<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Address;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;

class CheckoutService
{
    public function getCustomer($userId)
    {
        return Customer::find($userId);
    }

    public function storeAddress(array $addressData)
    {
        Session::put('checkout.address', $addressData);
    }

    public function storePayment(array $paymentData)
    {
        Session::put('checkout.payment', $paymentData);
    }

    public function getCheckoutData()
    {
        return [
            'address' => Session::get('checkout.address'),
            'payment' => Session::get('checkout.payment'),
            'cartItems' => Session::get('cart')
        ];
    }

    public function placeOrder($customerId)
    {
        $addressData = Session::get('checkout.address');
        $paymentData = Session::get('checkout.payment');
        $cartItems = Session::get('cart');

        // Store Address
        $address = $this->createAddress($customerId, $addressData);

        // Store Order
        $order = $this->createOrder($customerId, $address->id, $cartItems);

        // Store Order Items
        $this->createOrderItems($order->id, $cartItems);

        // Store Payment
        $this->createPayment($order->id, $paymentData);

        // // Clear session
        // $this->clearCheckoutSession();

        return $order;
    }

    private function createAddress($customerId, $addressData)
    {
        return Address::create([
            'customer_id' => $customerId,
            'street' => $addressData['street'],
            'city' => $addressData['city'],
            'zipcode' => $addressData['zipcode'],
            'recipient_name' => $addressData['recipient_name'],
        ]);
    }

    private function createOrder($customerId, $addressId, $cartItems)
    {
        return Order::create([
            'customer_id' => $customerId,
            'address_id' => $addressId,
            'total_amount' => array_sum(array_column($cartItems, 'price')),
            'status' => 'Pending',
        ]);
    }

    private function createOrderItems($orderId, $cartItems)
    {
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $orderId,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }
    }

    private function createPayment($orderId, $paymentData)
    {
        return Payment::create([
            'order_id' => $orderId,
            'payment_method' => $paymentData['payment_method'],
            'status' => 'Paid',
        ]);
    }

    private function clearCheckoutSession()
    {
        Session::forget(['checkout', 'cart']);
    }

}