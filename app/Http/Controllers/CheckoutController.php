<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CheckoutService;
use App\Services\CartService;

class CheckoutController extends Controller
{
    protected $checkoutService;
    protected $cartService;

    public function __construct(CheckoutService $checkoutService,CartService $cartService)
    {
        $this->checkoutService = $checkoutService;
        $this->cartService = $cartService;
    }

    // Step 1: Address Page
    public function showAddressPage()
    {
        $customer = $this->checkoutService->getCustomer(auth()->user()->id);
        return view('user.checkout-address', compact('customer'));
    }

    public function storeAddress(Request $request)
    {
        $request->validate([
            'street' => 'required|string',
            'city' => 'required|string',
            'zipcode' => 'required|digits:5',
        ]);

        $this->checkoutService->storeAddress($request->all());

        return redirect()->route('checkout.payment.show');
    }

    // Step 2: Payment Page
    public function showPaymentPage()
    {
        return view('user.checkout-payment');
    }

    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
        ]);

        $this->checkoutService->storePayment($request->all());

        return redirect()->route('checkout.review');
    }

    // Step 3: Review Page
    public function showReviewPage()
    {
        $checkoutData = $this->checkoutService->getCheckoutData();
        return view('user.checkout-review', $checkoutData);
    }

    public function placeOrder()
    {
        $customer = $this->checkoutService->getCustomer(auth()->user()->id);
        // dd($customer);
        $order = $this->cartService->getCart();
        return view('user.checkout-confirmation', compact('customer', 'order'));
    }

}