<?php

namespace App\Domains\Customer\Commands;

use App\Bus\Command\Command;

class CreateCustomerCommand extends Command
{
    public function __construct(
        private readonly string $first_name,
        private readonly string $last_name,
        private readonly string $email,
        private readonly string $phone_number,
        private readonly string $bank_account_number,
        private readonly string $date_of_birth,
    ) {}

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'bank_account_number' => $this->bank_account_number,
            'date_of_birth' => $this->date_of_birth,
        ];
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): string
    {
        return $this->phone_number;
    }

    public function getBankAccountNumber(): string
    {
        return $this->bank_account_number;
    }

    public function getDateOfBirth(): string
    {
        return $this->date_of_birth;
    }

}
