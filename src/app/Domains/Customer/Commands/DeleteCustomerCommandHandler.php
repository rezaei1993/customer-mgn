<?php

namespace App\Domains\Customer\Commands;

use App\Bus\Command\CommandHandler;
use App\Domains\Customer\Repositories\Contracts\WriteCustomerRepositoryContract;

class DeleteCustomerCommandHandler extends CommandHandler
{
    public function __construct(
        protected WriteCustomerRepositoryContract $writeCustomerRepositoryContract,
    )
    {
    }


    public function handle(DeleteCustomerCommand $command): int
    {
        return $this->writeCustomerRepositoryContract->delete( $command->getCustomer());
    }
}
