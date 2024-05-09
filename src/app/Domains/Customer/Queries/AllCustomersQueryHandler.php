<?php

namespace App\Domains\Customer\Queries;

use App\Bus\Query\Query;
use App\Domains\Customer\Repositories\Contracts\ReadCustomerRepositoryContract;

class AllCustomersQueryHandler extends Query
{

    public function __construct(
        protected readonly ReadCustomerRepositoryContract $readCustomerRepositoryContract,
    ) {}

    public function handle(AllCustomersQuery $query): ?object
    {
        return $this->readCustomerRepositoryContract->all();
    }

}
