<?php

namespace App\Domains\Customer\Events\Listeners;

use App\Domains\Customer\Events\CreateCustomerEvent;
use App\Domains\Customer\Events\DeleteCustomerEvent;
use App\Domains\Customer\Events\UpdateCustomerEvent;
use Illuminate\Support\Facades\DB;

class CustomerEventsSubscriber
{
    public function handleCustomerCreation(CreateCustomerEvent $event): void
    {
        $this->storeEvent($event->customer->toArray(), 'create');
    }

    public function handleCustomerUpdation(UpdateCustomerEvent $event): void
    {
        $this->storeEvent($event->customer->toArray(), 'update');
    }

    public function handleCustomerDeletion(DeleteCustomerEvent $event): void
    {
        $this->storeEvent($event->customer->getCustomer()->toArray(), 'delete');
    }

    protected function storeEvent(array $data, string $eventType): void
    {
        DB::table('stored_events')->insert([
            'event_type' => $eventType,
            'aggregate_type' => 'Customer',
            'event_data' => json_encode($data),
            'occurred_at' => now(),
        ]);
    }


    public function subscribe($events): void
    {
        $events->listen(CreateCustomerEvent::class, [CustomerEventsSubscriber::class, 'handleCustomerCreation']);
        $events->listen(UpdateCustomerEvent::class, [CustomerEventsSubscriber::class, 'handleCustomerUpdation']);
        $events->listen(DeleteCustomerEvent::class, [CustomerEventsSubscriber::class, 'handleCustomerDeletion']);
    }
}
