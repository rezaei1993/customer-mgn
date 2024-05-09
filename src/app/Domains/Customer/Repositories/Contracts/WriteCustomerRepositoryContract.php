<?php

namespace App\Domains\Customer\Repositories\Contracts;


use App\Domains\Customer\Models\Customer;

interface WriteCustomerRepositoryContract
{
    public function create(array $data): int;

    public function update(Customer $customer, array $data): int;

    public function delete(Customer $customer): ?bool;

}
