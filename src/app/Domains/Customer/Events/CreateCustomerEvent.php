<?php

namespace App\Domains\Customer\Events;

use App\Domains\Customer\Commands\CreateCustomerCommand;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateCustomerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public CreateCustomerCommand $customer)
    {
        //
    }
}
