<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Services\Payment\StripePayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Stripe\StripeClient;

class PaymentController extends Controller
{
    public function create(StripePayment $stripePayment, Subscription $subscription)
    {
        return $stripePayment->createCheckoutSession($subscription);
    }
    public function success(Request $request)
    {
        // return view('thenkyou');
        return to_route('classroom.index');
    }
    public function cancel()
    {
        return view('payment.cancel');
    }
}
