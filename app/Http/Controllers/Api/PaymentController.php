<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // 🔹 GET /api/payments
    public function index()
    {
        $payments = Payment::with('customer', 'refunds')->get();
        return response()->json($payments);
    }

    // 🔹 GET /api/payments/{id}
    public function show($id)
    {
        $payment = Payment::with('customer', 'refunds')->find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        return response()->json($payment);
    }

    // 🔹 POST /api/payments
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'amount' => 'required|numeric|min:0',
            'currency' => 'required|string|max:3',
            'status' => 'required|string',
            'provider' => 'required|string',
            'provider_payment_id' => 'nullable|string'
        ]);

        $payment = Payment::create($validated);
        return response()->json($payment, 201);
    }

    // 🔹 PUT /api/payments/{id}
    public function update(Request $request, $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'currency' => 'sometimes|string|max:3',
            'status' => 'sometimes|string',
            'provider' => 'sometimes|string',
            'provider_payment_id' => 'nullable|string'
        ]);

        $payment->update($validated);
        return response()->json($payment);
    }

    // 🔹 DELETE /api/payments/{id}
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }

        $payment->delete();
        return response()->json(['message' => 'Payment deleted successfully']);
    }
}
