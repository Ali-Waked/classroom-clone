<?php

namespace App\Http\Controllers;

use App\Actions\CreateSubscription;
use App\Enums\SubscriptionStatus;
use App\Http\Requests\SubscriptionRequest;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Throwable;

class SubscriptionController extends Controller
{
    public function store(SubscriptionRequest $request, CreateSubscription $createSubscription): RedirectResponse
    {
        $plan = Plan::findOrFail($request->post('plan_id'));
        $months = $request->post('period');
        try {
            $subscription = $createSubscription->handle([
                'plan_id' => $plan->id,
                'user_id' => $request->user()->id,
                'price' => $plan->price * $months,
                'expires_at' => now()->addMonths($months),
                'status' => SubscriptionStatus::PENDING
            ]);
            return to_route('checkout', [$subscription]);
        } catch (Throwable $e) {
            return back()->with('message', $e->getMessage());
        }

        // return to_route('classroom.index')->with('success', __('The Subscription Has Been Activated Successfully'));
    }
}
