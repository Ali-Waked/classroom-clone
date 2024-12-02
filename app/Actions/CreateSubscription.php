<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscription
{
    /**
     * subscription user for classroom
     *
     * @param array $data
     * @return Subscription
     */
    public function handle(array $data): Subscription
    {
        return Subscription::create($data);
    }
}
