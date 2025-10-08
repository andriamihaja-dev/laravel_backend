<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Refund;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    // 🔹 GET /api/refunds
    public function index()
    {
        $refunds = Refund::with('payment')->get();
        return response()->json($refunds);
    }

    // 🔹 GET /api/refunds/{id}
    public function show($id)
    {
        $refund = Refund::with('payment')->find($id);
        if (!$refund) {
            return response()->json(['message' => 'Refund not found'], 404);
        }
        return response()->json($refund);
    }

    // 🔹 POST /api/refunds
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payment_id' => 'required|exists:payments,id',
            'amount' => 'required|numeric|min:0',
            'provider_refund_id' => 'nullable|string',
            'reason' => 'nullable|string'
        ]);

        $refund = Refund::create($validated);
        return response()->json($refund, 201);
    }

    // 🔹 PUT /api/refunds/{id}
    public function update(Request $request, $id)
    {
        $refund = Refund::find($id);
        if (!$refund) {
            return response()->json(['message' => 'Refund not found'], 404);
        }

        $validated = $request->validate([
            'amount' => 'sometimes|numeric|min:0',
            'provider_refund_id' => 'nullable|string',
            'reason' => 'nullable|string'
        ]);

        $refund->update($validated);
        return response()->json($refund);
    }

    // 🔹 DELETE /api/refunds/{id}
    public function destroy($id)
    {
        $refund = Refund::find($id);
        if (!$refund) {
            return response()->json(['message' => 'Refund not found'], 404);
        }

        $refund->delete();
        return response()->json(['message' => 'Refund deleted successfully']);
    }
}
