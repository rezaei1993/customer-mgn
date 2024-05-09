<?php

namespace App\Domains\Customer\Http\Controllers\Web;

use App\Domains\Customer\Http\Requests\CustomerRequest;
use App\Domains\Customer\Models\Customer;
use App\Domains\Customer\Services\Contracts\CustomerServiceContract;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Log;

class CustomerController
{

    public function __construct(
        protected CustomerServiceContract $customerServiceContract
    )
    {
    }


    public function index(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $customers = $this->customerServiceContract->getCustomers();
        return view('customers.index', ['customers' => $customers]);
    }


    public function store(CustomerRequest $request): RedirectResponse
    {
        $this->customerServiceContract->createCustomer($request);
        return redirect()->back()->with('message', Lang::get('custom_messages.success'))->with('alert-type', 'success');
    }

    public function show(Customer $customer)
    {
        return view('customers.edit', ['customer' => $customer]);
    }


    public function update(CustomerRequest $request, Customer $customer): RedirectResponse
    {
        $this->customerServiceContract->updateCustomer($request, $customer);
        return redirect()->back()->with('message', Lang::get('custom_messages.success'))->with('alert-type', 'success');
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $this->customerServiceContract->deleteCustomer($customer);
        return redirect()->back()->with('message', Lang::get('custom_messages.success'))->with('alert-type', 'success');
    }
}
