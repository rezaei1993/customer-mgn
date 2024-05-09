<?php

namespace App\Domains\Customer\Repositories;

use App\Domains\Customer\Models\Customer;
use App\Domains\Customer\Repositories\Contracts\ReadCustomerRepositoryContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReadCustomerRepository implements ReadCustomerRepositoryContract
{
    public function find(int $id): ?object
    {
        return DB::table('customers')->where('id', $id)->first();
    }

    public function all(): Collection
    {
        return DB::table('customers')->get();
    }
}
