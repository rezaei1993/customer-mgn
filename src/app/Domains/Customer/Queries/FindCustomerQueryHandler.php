<?php

namespace App\Domains\Customer\Queries;

use App\Bus\Query\Query;
use App\Domains\Customer\Repositories\ReadCustomerRepository;

class FindCustomerQueryHandler extends Query
{

    public function __construct(
        protected readonly ReadCustomerRepository $repository,
    ) {}

    public function handle(FindCustomerQuery $query): ?object
    {
        return $this->repository->find(
            $query->getId(),
        );
    }

}
