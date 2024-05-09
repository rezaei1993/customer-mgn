<?php

namespace App\Domains\Customer\Commands;

use App\Bus\Command\CommandHandler;
use App\Domains\Customer\Repositories\Contracts\WriteCustomerRepositoryContract;

class UpdateCustomerCommandHandler extends CommandHandler
{
    public function __construct(
        protected WriteCustomerRepositoryContract $writeCustomerRepositoryContract,
    )
    {
    }


    public function handle(UpdateCustomerCommand $command): int
    {
        return $this->writeCustomerRepositoryContract->update($command->getCustomer(), $command->toArray());
    }
}
