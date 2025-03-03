<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Services\CustomerService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CustomerRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{
    use HttpResponses;
    public function __construct(protected CustomerService $customerService) {}
    public function create(CustomerRequest $request)
    {
        $cusData = $request->validated();
        return $this->customerService->create($cusData, $request);
    }

    public function index()
    {
        $customers = Customer::where('user_id', Auth::id())->latest()->paginate(10);
        return $this->success($customers, 'Customers fetched successfully');
    }

    public function allCustomers() {
        $customers = Customer::latest()->paginate(10);
        return $this->success($customers, 'Customers fetched successfully');
    }


    public function show($id)
    {
        return $this->customerService->show($id);
    }

    public function update(CustomerUpdateRequest $request, $id)
    {        
        $validated = $request->validated();
        return $this->customerService->update($validated, $id);
    }

    public function destroy($id)
    {
        return $this->customerService->destroy($id);
    }
}
