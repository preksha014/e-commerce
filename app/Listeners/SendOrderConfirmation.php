<?php

namespace App\Listeners;

use App\Events\OrderPlaced;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Exception;

class SendOrderConfirmation
{
    public function handle(OrderPlaced $event): void
    {
        try {
            // Ensure relationships are loaded
            $order = $event->order->load('customer', 'order_items');

            Log::info('Order Data:', [$order->toArray()]);
            Log::info('Customer Data:', [$order->customer ? $order->customer->toArray() : 'No customer']);

            // Check if customer exists and has an email
            if ($order->customer && $order->customer->email) {
                Mail::to($order->customer->email)
                    ->queue(new OrderConfirmation($order, false));
                Log::info("Order confirmation email sent to customer: {$order->customer->email}");
            } else {
                Log::error("Customer email not found for order: {$order->id}");
            }

            // Send confirmation to admin
            Mail::to('admin@yourdomain.com')
                ->queue(new OrderConfirmation($order, true));
            Log::info("Order confirmation email sent to admin.");

        } catch (Exception $e) {
            Log::error("Error in SendOrderConfirmation Listener: " . $e->getMessage(), [
                'order_id' => $event->order->id ?? 'Unknown',
                'exception' => $e,
            ]);
        }
    }
}
