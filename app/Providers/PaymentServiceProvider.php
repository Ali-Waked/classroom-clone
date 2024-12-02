<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use Stripe\StripeClient;

class PaymentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(StripeClient::class, fn () => new StripeClient(Config::get('services.stripe.secret_key')));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
