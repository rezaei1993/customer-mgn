<?php

namespace App\Domains\Customer\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'date_of_birth' => $this->date_of_birth,
            'phone_number' => $this->phone_number,
            'bank_account_number' => $this->bank_account_number,
        ];
    }
}
