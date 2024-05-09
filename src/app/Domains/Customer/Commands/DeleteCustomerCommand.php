<?php

namespace App\Domains\Customer\Commands;

use App\Bus\Command\Command;
use App\Domains\Customer\Models\Customer;

class DeleteCustomerCommand extends Command
{
    public function __construct(
        private readonly Customer $customer,
    ) {}

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

}
