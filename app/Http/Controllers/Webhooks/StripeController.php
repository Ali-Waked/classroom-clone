<?php

namespace App\Http\Controllers\Webhooks;

use App\Enums\PaymentStatus;
use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function __invoke(Request $request, StripeClient $stripeClient)
    {
        $endpoint_secret = 'whsec_68325be8873fbde3d664db09d1b3aeecfcd36c860352199197e62f04b7b21cc0';

        $payload = @file_get_contents('php://input'); // read body of content
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload,
                $sig_header,
                $endpoint_secret
            );
        } catch (\UnexpectedValueException $e) {
            // Invalid payload
            // http_response_code(400);
            // exit();
            return response('', 400);
        } catch (\Stripe\Exception\SignatureVerificationException $e) {
            // Invalid signature
            // http_response_code(400);
            // exit();
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                Payment::where('gatway_reference_id', $session->id)->forceFill([
                    'gatway_reference_id' => $session->payment_intent,
                ])->save();
                break;
            case 'checkout.session.expired':
                $session = $event->data->object;
                break;

            case 'payment_intent.amount_capturable_updated':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.canceled':
                $paymentIntent = $event->data->object;
                // Delete subscription
                break;

            case 'payment_intent.created':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.partially_funded':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.processing':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.requires_action':
                $paymentIntent = $event->data->object;
                break;

            case 'payment_intent.succeeded':
                $paymentIntent = $event->data->object;
                $payment = Payment::where('gatway_reference_id', $paymentIntent->id)->first();
                $payment->forceFill([
                    'status' => PaymentStatus::COMPLETED->value,
                ])->save();
                $subscription = Subscription::where('id', $payment->subscription_id)->first();
                $subscription->update([
                    'status' => 'active',
                    'expires_at' => now()->addMonths(3),
                ]);
                break;

                // ... handle other event types
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('', 200);
    }
}
