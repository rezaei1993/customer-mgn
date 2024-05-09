<?php

namespace Tests\Feature\Api;

use App\Domains\Customer\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testRetrieveListOfCustomers(): void
    {
        Customer::factory()->count(5)->create();

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => ['id', 'first_name', 'last_name', 'email', 'date_of_birth', 'phone_number', 'bank_account_number']
            ]
        ]);

        $this->assertEquals(5, count($response->json('data')));
    }


    /**
     * @return void
     */
    public function testCreateCustomerWithValidData()
    {
        $validCustomerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '123456789',
            'bank_account_number' => '1234567890123',
            'date_of_birth' => '1990-01-01',
        ];

        $response = $this->postJson('/api/customers', $validCustomerData);

        $response->assertStatus(201);

        $this->assertDatabaseHas('customers', $validCustomerData);

    }


    /**
     * @return void
     */
    public function testCreateCustomerWithInvalidData()
    {
        $invalidCustomerData = [
            'email' => 'john@example.com',
            'phone_number' => '123456789',
            'bank_account_number' => '1234567890123',
            'date_of_birth' => '1990-01-01',
        ];

        $response = $this->postJson('/api/customers', $invalidCustomerData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['first_name', 'last_name']);
    }


    /**
     * @return void
     */
    public function testUpdateCustomerWithValidData()
    {
        $customer = Customer::factory()->create();

        $validCustomerData = [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'phone_number' => '123456789',
            'bank_account_number' => '1234567890123',
            'date_of_birth' => '1990-01-01',
        ];

        $response = $this->patchJson("/api/customers/{$customer->id}", $validCustomerData);

        $response->assertStatus(200);

        $this->assertDatabaseHas('customers', $validCustomerData);
    }


    /**
     * @return void
     */
    public function testUpdateCustomerWithInvalidData()
    {
        $customer = Customer::factory()->create();

        $invalidCustomerData = [
            'email' => 'updated_email@example.com',
            'phone_number' => '987654321',
        ];

        $response = $this->patchJson("/api/customers/{$customer->id}", $invalidCustomerData);

        $response->assertStatus(422);
    }


    /**
     * @return void
     */
    public function testDeleteCustomer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson("/api/customers/{$customer->id}");

        $response->assertStatus(204);

        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }

}
