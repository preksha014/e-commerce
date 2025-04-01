<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Address;
use App\Models\Customer;
use App\Models\ShippingAddress;
use Illuminate\Support\Facades\Session;

class CheckoutService
{
    public function getCustomer($userId)
    {
        return Customer::with('address')->find($userId);
    }

    public function storeAddress(array $addressData, $customerId)
    {
        // Store in session for later use
        Session::put('checkout.address', $addressData);
        
        // If it's a new address and set as default is checked
        if (isset($addressData['set_as_default']) && $addressData['set_as_default']) {
            Address::create([
                'customer_id' => $customerId,
                'street' => $addressData['street'],
                'city' => $addressData['city'],
                'zipcode' => $addressData['zipcode'],
                'recipient_name' => $addressData['recipient_name']
            ]);
        }
        
        return $addressData;
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

        // dd($paymentData);
        // Create Order
        $order = Order::create([
            'customer_id' => $customerId,
            'status' => 'pending',
            'total_amount' => array_sum(array_column($cartItems, 'price')),
        ]);

        // dd($order);
        // Store Shipping Address (always create new shipping address record)
        $shippingAddress = ShippingAddress::create([
            'customer_id' => $customerId,
            'order_id' => $order->id,
            'street' => $addressData['street'],
            'city' => $addressData['city'],
            'zipcode' => $addressData['zipcode'],
            'recipient_name' => $addressData['recipient_name']
        ]);

        // dd($shippingAddress);

        // Store Order Items
        $this->createOrderItems($order->id, $cartItems);

        // Store Payment
        $this->createPayment($order->id, $paymentData);

        // Clear session
        $this->clearCheckoutSession();
        return $order;
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