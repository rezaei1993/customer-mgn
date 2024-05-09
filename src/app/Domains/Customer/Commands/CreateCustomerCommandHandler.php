<?php

namespace App\Domains\Customer\Commands;

use App\Bus\Command\CommandHandler;
use App\Domains\Customer\Repositories\Contracts\WriteCustomerRepositoryContract;

class CreateCustomerCommandHandler extends CommandHandler
{
    public function __construct(
        protected WriteCustomerRepositoryContract $writeCustomerRepositoryContract,
    )
    {
    }


    public function handle(CreateCustomerCommand $command): int
    {
        return $this->writeCustomerRepositoryContract->create($command->toArray());
    }
}
