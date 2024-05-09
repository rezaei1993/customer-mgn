<?php

namespace App\Domains\Customer\Http\Requests;

use App\Domains\Customer\Rule\UniqueCustomer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CustomerRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => ['string', 'min:3', 'max:50', 'required'],
            'last_name' => ['string', 'min:3', 'max:50', 'required'],
            'email' => ['email', 'max:50', 'required'],
            'phone_number' => ['string', 'min:3', 'max:15', 'required'],
            'bank_account_number' => ['string', 'min:13', 'max:20', 'required'],
            'date_of_birth' => ['date', 'nullable', new UniqueCustomer],
        ];
    }
}
