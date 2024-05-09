<?php

namespace App\Domains\Customer\Events;

use App\Domains\Customer\Commands\UpdateCustomerCommand;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateCustomerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public UpdateCustomerCommand $customer)
    {
        //
    }

}
