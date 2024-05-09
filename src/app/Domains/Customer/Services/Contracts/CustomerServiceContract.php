<?php

namespace App\Domains\Customer\Services\Contracts;

use App\Domains\Customer\Http\Requests\CustomerRequest;
use App\Domains\Customer\Models\Customer;
use Illuminate\Support\Collection;

interface CustomerServiceContract
{
    public function getCustomers(): Collection;
    public function createCustomer(CustomerRequest $request):  ?object;
    public function updateCustomer(CustomerRequest $request, Customer $customer): ?object;
    public function deleteCustomer(Customer $customer): bool;
}
