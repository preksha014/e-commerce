<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use App\Services\CartService;
use Exception;
use App\Events\OrderPlaced;
use App\Models\Address;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $checkoutService;
    protected $cartService;

    public function __construct(CheckoutService $checkoutService, CartService $cartService)
    {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
    }

    // Step 1: Address Page
    public function showAddressPage()
    {
        try {
            $customer = $this->checkoutService->getCustomer(auth()->user()->id);
            $addresses = Address::where('customer_id', $customer->id)->get();
            return view('user.checkout-address', compact('customer', 'addresses'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load address page. Please try again.');
        }
    }

    public function storeAddress(Request $request)
    {
        try {
            $customerId = auth()->user()->id;

            if ($request->has('address_id') && !$request->has('street')) {
                $address = Address::findOrFail($request->address_id);
                $addressData = $address->only(['street', 'city', 'zipcode', 'recipient_name']);
            } else {
                $request->validate([
                    'street' => 'required|string',
                    'city' => 'required|string',
                    'zipcode' => 'required|digits:5',
                    'recipient_name' => 'required|string'
                ]);
                $addressData = $request->only(['street', 'city', 'zipcode', 'recipient_name']);
                $addressData['set_as_default'] = $request->has('set_as_default');
            }

            $this->checkoutService->storeAddress($addressData, $customerId);
            return redirect()->route('checkout.payment.show');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save address. Please try again.');
        }
    }

    // Step 2: Payment Page
    public function showPaymentPage(Request $request)
    {
        try {
            return view('user.checkout-payment');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load payment page. Please try again.');
        }
    }

    public function storePayment(Request $request)
    {
        try {
            $request->validate([
                'payment_method' => 'required',
            ]);

            $this->checkoutService->storePayment($request->all());
            return redirect()->route('checkout.review');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save payment details. Please try again.');
        }
    }

    // Step 3: Review Page
    public function showReviewPage()
    {
        try {
            // dd('dfd');
            $checkoutData = $this->checkoutService->getCheckoutData();
            if (is_null($checkoutData['address']) || is_null($checkoutData['payment']) || is_null($checkoutData['cartItems'])) {
                throw new Exception('Incomplete checkout data');
            }
            return view('user.checkout-review', $checkoutData);
        } catch (Exception $e) {

            return redirect('home')->with('error', 'Failed to load review page. Please try again.');
        }
    }
    public function placeOrder()
    {
        try {
            $customer = $this->checkoutService->getCustomer(auth()->user()->id);

            // Check if we have necessary session data
            if (!Session::has('checkout.address') || !Session::has('cart')) {
                return back()->with('error', 'Checkout information is incomplete. Please start the checkout process again.');
            }

            $order = $this->checkoutService->placeOrder($customer->id);

            if (!$order) {
                throw new Exception('Order creation failed');
            }
            $total = $this->cartService->getTotal();
            $order->load('order_items');
            event(new OrderPlaced($order));

            return view('user.checkout-confirmation', compact('customer', 'order', 'total'));
        } catch (Exception $e) {
            // Log the error for debugging
            \Log::error('Order placement failed: ' . $e->getMessage());
            return redirect('home')->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}
