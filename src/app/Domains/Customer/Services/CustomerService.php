<?php

namespace App\Domains\Customer\Services;

use App\Bus\Command\CommandBus;
use App\Bus\Query\QueryBus;
use App\Domains\Customer\Commands\CreateCustomerCommand;
use App\Domains\Customer\Commands\DeleteCustomerCommand;
use App\Domains\Customer\Commands\UpdateCustomerCommand;
use App\Domains\Customer\Events\CreateCustomerEvent;
use App\Domains\Customer\Events\DeleteCustomerEvent;
use App\Domains\Customer\Events\UpdateCustomerEvent;
use App\Domains\Customer\Http\Requests\CustomerRequest;
use App\Domains\Customer\Models\Customer;
use App\Domains\Customer\Queries\AllCustomersQuery;
use App\Domains\Customer\Queries\FindCustomerQuery;
use App\Domains\Customer\Services\Contracts\CustomerServiceContract;
use Illuminate\Support\Collection;


class CustomerService implements CustomerServiceContract
{

    public function __construct(
        protected CommandBus $commandBus,
        protected QueryBus   $queryBus,
    )
    {
    }

    public function createCustomer(CustomerRequest $request):  ?object
    {
        $createCustomerCommand = new CreateCustomerCommand(
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone_number,
            $request->bank_account_number,
            $request->date_of_birth,
        );

        $customerId = $this->commandBus->dispatch($createCustomerCommand);
        event(new CreateCustomerEvent($createCustomerCommand));

        return $this->queryBus->ask(new FindCustomerQuery($customerId));
    }

    public function getCustomers(): Collection
    {
        return $this->queryBus->ask(
            new AllCustomersQuery(),
        );
    }


    public function updateCustomer(CustomerRequest $request, Customer $customer):  ?object
    {
        $updateCustomerCommand = new UpdateCustomerCommand(
            $customer,
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->phone_number,
            $request->bank_account_number,
            $request->date_of_birth,
        );
        $customerId = $this->commandBus->dispatch($updateCustomerCommand);
        event(new UpdateCustomerEvent($updateCustomerCommand));
        return $this->queryBus->ask(new FindCustomerQuery($customerId));
    }


    public function deleteCustomer(Customer $customer): bool
    {
        $deleteCustomerCommand = new DeleteCustomerCommand($customer);
        $this->commandBus->dispatch($deleteCustomerCommand);
        event(new DeleteCustomerEvent($deleteCustomerCommand));
        return true;
    }
}
