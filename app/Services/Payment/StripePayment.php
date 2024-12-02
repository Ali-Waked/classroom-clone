<?php

namespace App\Services\Payment;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Stripe\StripeClient;

class StripePayment
{
    public function createCheckoutSession(Subscription $subscription): RedirectResponse
    {
        $stripe = App::make(StripeClient::class);
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $subscription->plan->name,
                    ],
                    'unit_amount' => $subscription->plan->price * 100,
                ],
                'quantity' => $subscription->expires_at->diffInMonths($subscription->created_at),
            ]],
            'metadata' => [
                'subscription_id' => $subscription->id,
            ],
            'mode' => 'payment',
            'success_url' => route('payments.success', $subscription->id),
            'cancel_url' => route('payments.cancel', $subscription->id),
        ]);
        Payment::forceCreate([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price * 100,
            'currency_code' => 'usd',
            'payment_gatway' => 'stripe',
            'gatway_reference_id' => $checkout_session->id,
            'data' => $checkout_session,
        ]);
        return Redirect::away($checkout_session->url);
    }
}
