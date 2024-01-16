<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index($user)
    {
        $suppliers = Supplier::where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'suppliers' => $suppliers]);
    }

    public function store(Request $request, $user)
    {
        $data = $request->all();
        $data['user_id'] = $user;

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'message' => 'Error missing value requerid']);
        }

        if (!isset($data['name']) || !isset($data['email']) || !isset($data['phone'])) {
            return response()->json(['status' => 0, 'message' => 'The fields name, email and phone are required']);
        }

        $supplier = Supplier::where('email', $data['email'])->first();
        if ($supplier) {
            return response()->json(['status' => 0, 'message' => 'This email is registered']);
        }

        $supplier = Supplier::where('phone', $data['phone'])->first();
        if ($supplier) {
            return response()->json(['status' => 0, 'message' => 'This phone is registered']);
        }

        $lastCode = Supplier::where('user_id', $user)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'SUP' . str_pad($number, 3, '0', STR_PAD_LEFT);
        $supplier = Supplier::create($data);

        if (!$supplier) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register supplier']);
        }

        return response()->json(['status' => 1, 'supplier' => $supplier], 201);
    }

    public function show($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['status' => 0, 'message' => 'Supplier not found']);
        }

        return response()->json(['status' => 1, 'supplier' => $supplier]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $supplier = Supplier::find($data['id']);

        if (!$supplier) {
            return response()->json(['status' => 0, 'message' => 'Supplier not found']);
        }

        if ($request->has('email') && $request->email !== $supplier->email && Supplier::where('email', $request->email)->exists()) {
            return response()->json(['status' => 0, 'message' => 'Email is already taken by another supplier']);
        }

        if ($request->has('phone') && $request->phone !== $supplier->phone && Supplier::where('phone', $request->phone)->exists()) {
            return response()->json(['status' => 0, 'message' => 'Phone number is already taken by another supplier']);
        }

        $supplier->update($request->all());

        if (!$supplier) {
            return response()->json(['status' => 0, 'message' => 'Error trying update supplier']);
        }

        return response()->json(['status' => 1, 'data' => $supplier, 'message' => 'Supplier updated successfully']);
    }

    public function delete($id)
    {
        $supplier = Supplier::find($id);

        if (!$supplier) {
            return response()->json(['status' => 0, 'message' => 'Supplier not found'], 404);
        }

        $supplier->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Supplier deleted successfully']);
    }
}
