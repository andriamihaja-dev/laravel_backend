<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // 🔹 GET /api/customers
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    // 🔹 GET /api/customers/{id}
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    // 🔹 POST /api/customers
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:customers,email',
            'phone' => 'nullable|string',
            'provider' => 'nullable|string',
            'provider_customer_id' => 'nullable|string'
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    // 🔹 PUT /api/customers/{id}
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'email' => 'sometimes|email|unique:customers,email,' . $customer->id,
            'phone' => 'nullable|string',
            'provider' => 'nullable|string',
            'provider_customer_id' => 'nullable|string'
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    // 🔹 DELETE /api/customers/{id}
    public function destroy($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
