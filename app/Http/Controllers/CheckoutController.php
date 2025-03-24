<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use App\Services\CartService;
use Exception;

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
            return view('user.checkout-address', compact('customer'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load address page. Please try again.');
        }
    }

    public function storeAddress(Request $request)
    {
        try {
            $request->validate([
                'street' => 'required|string',
                'city' => 'required|string',
                'zipcode' => 'required|digits:5',
            ]);

            $this->checkoutService->storeAddress($request->all());
            return redirect()->route('checkout.payment.show');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to save address. Please try again.');
        }
    }

    // Step 2: Payment Page
    public function showPaymentPage()
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
            $checkoutData = $this->checkoutService->getCheckoutData();
            return view('user.checkout-review', $checkoutData);
        } catch (Exception $e) {
            return back()->with('error', 'Failed to load review page. Please try again.');
        }
    }

    public function placeOrder()
    {
        try {
            $customer = $this->checkoutService->getCustomer(auth()->user()->id);
            $order = $this->cartService->getCart();
            $total = $this->cartService->getTotal();
            return view('user.checkout-confirmation', compact('customer', 'order', 'total'));
        } catch (Exception $e) {
            return back()->with('error', 'Failed to place order. Please try again.');
        }
    }
}
