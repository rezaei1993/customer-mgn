<?php

namespace Tests\Browser;

use App\Domains\Customer\Models\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTruncation;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CustomerManagementTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test creating a new customer.
     *
     * @return void
     * @throws \Throwable
     */
    public function testCreateCustomer()
    {

        $this->browse(function (Browser $browser) {
            $browser->visit('/customers')
                ->waitFor('.add-btn-success')
                ->click('.add-btn-success')
                ->waitFor('.add-modal-body')
                ->keys('#add_first_name', 'Johni')
                ->keys('#add_last_name', 'Doei')
                ->keys('#add_email', 'john8237@example.com')
                ->keys('#add_phone_number', '1484568901')
                ->keys('#add_bank_account_number', '187456339101112')
                ->keys('#add_date_of_birth', '1990-01-01')
                ->press('Add')
                ->assertPathIs('/customers')
                ->assertSee('Success')
                ->assertSee('Johni Doei');
        });
    }

    /**
     * Test editing a customer.
     *
     * @return void
     * @throws \Throwable
     */
    public function testEditCustomer()
    {
        $this->browse(function (Browser $browser) {

            $customer = Customer::factory()->create();

            $browser->visit('/customers/'.$customer->id)
                ->assertSee('Edit Customer')
                ->type('first_name', 'John')
                ->type('last_name', 'Doe')
                ->type('email', 'john.doe@example.com')
                ->type('phone_number', '1234567890')
                ->type('bank_account_number', '1234567891234')
                ->type('date_of_birth', '1990-01-01')
                ->press('Update')
                ->assertPathIs('/customers/'.$customer->id)
                ->assertSee('Success');
        });
    }

    /**
     * Test deleting a customer.
     *
     * @return void
     * @throws \Throwable
     */
    public function testDeleteCustomer()
    {
        $customer = Customer::factory()->create();

        $this->browse(function (Browser $browser) use ($customer) {
            $browser->visit('/customers')
                ->assertSee($customer->first_name.' '.$customer->last_name)
                ->waitFor("#delete_{$customer->id}")
                ->press("#delete_{$customer->id}")
                ->assertPathIs('/customers')
                ->assertSee('Success');
        });

    }
}
