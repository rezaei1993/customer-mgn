<?php

namespace App\Domains\Customer\Http\Controllers\Api;

use App\Domains\Customer\Http\Requests\CustomerRequest;
use App\Domains\Customer\Models\Customer;
use App\Domains\Customer\Resources\CustomerResource;
use App\Domains\Customer\Services\Contracts\CustomerServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class CustomerController
{

    public function __construct(
        protected CustomerServiceContract $customerServiceContract
    )
    {
    }


    /**
     * @OA\Get(
     *     path="/api/customers",
     *     tags={"Customer"},
     *     summary="List all customers",
     *     description="Get a list of all customers.",
     * @OA\Response(
     * *    response=200,
     * *    description="Success",
     * *    @OA\JsonContent(
     * *       type="array",
     * *       @OA\Items(ref="#/components/schemas/Customer")
     * *        )
     * *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */
    public function index(){
        try {
            return response()->json([
                'status' => Lang::get('custom_messages.success'),
                'data' => CustomerResource::collection($this->customerServiceContract->getCustomers())
            ], ResponseAlias::HTTP_OK);

        } catch (\Exception $exception) {
            Log::error(route('api.customers.index'), [
                __FILE__ => $exception->getMessage()]);

            return response()->json([
                'status' => Lang::get('custom_messages.fail'),
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/customers",
     *     tags={"Customer"},
     *     summary="Create a new customer",
     *     description="Create a new customer with the provided details.",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"first_name", "last_name", "email", "phone_number", "bank_account_number"},
     *             @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com", description="Customer's email address"),
     *             @OA\Property(property="phone_number", type="string", example="1234567890", description="Customer's phone number"),
     *             @OA\Property(property="bank_account_number", type="string", example="1234567890123", description="Customer's bank account number"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", nullable=true, example="1990-01-01", description="Customer's date of birth")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Customer created successfully"),
     *            @OA\Property(property="data", type="object", ref="#/components/schemas/Customer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        try {
            return response()->json([
                'status' => Lang::get('custom_messages.success'),
                'message' => Lang::get('custom_messages.update_success'),
                'data' => CustomerResource::make($this->customerServiceContract->createCustomer($request))
            ], ResponseAlias::HTTP_CREATED);

        } catch (\Exception $exception) {
            Log::error(route('api.customers.update'), [
                __FILE__ => $exception->getMessage()]);

            return response()->json([
                'status' => Lang::get('custom_messages.fail'),
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @OA\Put(
     *     path="/api/customers/{customer}",
     *     tags={"Customer"},
     *     summary="Update an existing customer",
     *     description="Update an existing customer with the provided details.",
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="ID of the customer to update",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"first_name", "last_name", "email", "phone_number", "bank_account_number"},
     *             @OA\Property(property="first_name", type="string", example="John", description="Customer's first name"),
     *             @OA\Property(property="last_name", type="string", example="Doe", description="Customer's last name"),
     *             @OA\Property(property="email", type="string", format="email", example="john@example.com", description="Customer's email address"),
     *             @OA\Property(property="phone_number", type="string", example="1234567890", description="Customer's phone number"),
     *             @OA\Property(property="bank_account_number", type="string", example="1234567890123", description="Customer's bank account number"),
     *             @OA\Property(property="date_of_birth", type="string", format="date", nullable=true, example="1990-01-01", description="Customer's date of birth")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="success"),
     *             @OA\Property(property="message", type="string", example="Customer updated successfully"),
     *            @OA\Property(property="data", type="object", ref="#/components/schemas/Customer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */
    public function update(CustomerRequest $request, Customer $customer): JsonResponse
    {
        try {
            $customer = $this->customerServiceContract->updateCustomer($request, $customer);
            return response()->json([
                'status' => Lang::get('custom_messages.success'),
                'message' => Lang::get('custom_messages.update_success'),
                'data' => CustomerResource::make($customer)
            ], ResponseAlias::HTTP_OK);
        } catch (\Exception $exception) {
            Log::error(route('api.customers.update'), [
                __FILE__ => $exception->getMessage()]);

            return response()->json([
                'status' => Lang::get('custom_messages.fail'),
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


    /**
     * @OA\Delete(
     *     path="/api/customers/{customer}",
     *     tags={"Customer"},
     *     summary="Delete a customer",
     *     description="Delete an existing customer.",
     *     @OA\Parameter(
     *         name="customer",
     *         in="path",
     *         description="ID of the customer to delete",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Customer deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="string", example="fail"),
     *             @OA\Property(property="message", type="string", example="Internal Server Error")
     *         )
     *     )
     * )
     */
    public function destroy(Customer $customer): JsonResponse
    {
        try {
            $this->customerServiceContract->deleteCustomer($customer);

            return response()->json([
                'status' => Lang::get('custom_messages.success'),
                'message' => Lang::get('custom_messages.update_success'),
            ], ResponseAlias::HTTP_NO_CONTENT);
        } catch (\Exception $exception) {
            Log::error(route('api.customers.update'), [
                __FILE__ => $exception->getMessage()]);

            return response()->json([
                'status' => Lang::get('custom_messages.fail'),
                'message' => $exception->getMessage(),
            ], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
