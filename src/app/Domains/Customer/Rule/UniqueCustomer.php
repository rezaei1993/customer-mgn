<?php

namespace App\Domains\Customer\Rule;

use App\Domains\Customer\Models\Customer;
use Illuminate\Contracts\Validation\Rule;

class UniqueCustomer implements Rule
{
    public function passes($attribute, $value): bool
    {
        return !Customer::where('first_name', request('first_name'))
            ->where('last_name', request('last_name'))
            ->where('date_of_birth', request('date_of_birth'))
            ->exists();
    }

    public function message()
    {
        return 'The combination of first name, last name, and date of birth must be unique.';
    }
}
