<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Customer;
use App\Mail\RegisterMail;
use App\Traits\HttpResponses;
use App\Http\Resources\UserResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\CustomerResource;


class CustomerService
{
    use HttpResponses;
    public function create($cusData, $request)
    {
        if (isset($cusData['customer_cv'])) {
            $path = $cusData['customer_cv']->store('customer_cvs', 'public');
            $cusData['customer_cv'] = $path;
        }
        $customer = $request->user()->customers()->create($cusData);
        return $this->success('Customer created successfully', new CustomerResource($customer) );
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->error([], 'Customer not found');
        }
        $authAction = $this->authorizeAction($customer);
        if ($authAction) {
            return $this->error([], $authAction, 403);
        }
        return $this->success('Customer show successfully', $customer);
    }

    public function update($cusData, $customer)
    {
        $authAction = $this->authorizeAction($customer);
        if ($authAction) {
            return $this->error([], $authAction, 403);
        }
        if (isset($cusData['customer_cv'])) {
            $path = $cusData['customer_cv']->store('customer_cvs', 'public');
            $cusData['customer_cv'] = $path;
        }
        $customer->update($cusData);

        return $this->success('Customer updated successfully', new CustomerResource($customer));
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->error([], 'Customer not found', 404);
        }
        $authAction = $this->authorizeAction($customer);
        if ($authAction) {
            return $this->error([], $authAction, 403);
        }
        $customer->delete();
        return $this->success('Customer deleted successfully');
    }

    public function authorizeAction($customer)
    {
        $authResponse = Gate::inspect('modify', $customer);
        if (!$authResponse->allowed()) {
            return $authResponse->message();
        }
    }
}