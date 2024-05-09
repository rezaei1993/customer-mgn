<?php

namespace App\Domains\Customer\Queries;

use App\Bus\Query\Query;

class FindCustomerQuery extends Query
{

    public function __construct(
        private readonly int $id,
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

}
