<?php

namespace App\Domains\Customer\Events;

use App\Domains\Customer\Commands\DeleteCustomerCommand;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteCustomerEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(public DeleteCustomerCommand $customer)
    {
        //
    }

}
