<?php

namespace App\Domains\Customer\Repositories\Contracts;


use Illuminate\Support\Collection;

interface ReadCustomerRepositoryContract
{
    public function all(): Collection;
    public function find(int $id): ?object;
}
