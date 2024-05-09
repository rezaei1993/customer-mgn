<?php

namespace App\Domains\Customer\Repositories;

use App\Domains\Customer\Models\Customer;
use App\Domains\Customer\Repositories\Contracts\WriteCustomerRepositoryContract;
use Illuminate\Support\Facades\DB;

class WriteCustomerRepository implements WriteCustomerRepositoryContract
{

    public function create(array $data): int
    {
        return DB::table('customers')->insertGetId([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'date_of_birth' => $data['date_of_birth'],
            'phone_number' => $data['phone_number'],
            'bank_account_number' => $data['bank_account_number'],
        ]);
    }


    public function update(Customer $customer, array $data): int
    {
        $customer->update([
            'first_name' => $data['first_name'] ?? $customer->first_name,
            'last_name' => $data['last_name'] ?? $customer->last_name,
            'date_of_birth' => $data['date_of_birth'] ?? $customer->date_of_birth,
            'phone_number' => $data['phone_number'] ?? $customer->phone_number,
            'email' => $data['email'] ?? $customer->email,
            'bank_account_number' => $data['bank_account_number'] ?? $customer->bank_account_number,
        ]);

        return $customer->id;
    }

    public function delete(Customer $customer): ?bool
    {
        return $customer->delete();
    }
}
