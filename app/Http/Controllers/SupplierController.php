<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\ClientEmployeeAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Supplier;
use App\Models\User;

class SupplierController extends Controller
{
    public function index($userCode)
    {

        // Buscar en el modelo correspondiente según el prefijo del código
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Failed to register sale']);
        }

        // Verificar si se encontró un usuario válido
        if (!$clientUserId) {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        $suppliers = Supplier::where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'suppliers' => $suppliers]);
    }

    public function store(Request $request, $userCode)
    {
        $data = $request->all();

        // Buscar en el modelo correspondiente según el prefijo del código
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Failed to register sale']);
        }

        // Verificar si se encontró un usuario válido
        if (!$clientUserId) {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        $data['client_user_id'] = $clientUserId;

        if (!isset($data['name']) || !isset($data['email']) || !isset($data['phone'])) {
            return response()->json(['status' => 0, 'message' => 'The fields name, email and phone are required']);
        }

        $supplier = Supplier::where('email', $data['email'])->where('deleted', 0)->first();
        if ($supplier) {
            return response()->json(['status' => 0, 'message' => 'This email is registered']);
        }

        $supplier = Supplier::where('phone', $data['phone'])->where('deleted', 0)->first();
        if ($supplier) {
            return response()->json(['status' => 0, 'message' => 'This phone is registered']);
        }

        $lastCode = Supplier::where('client_user_id', $clientUserId)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'SUP' . str_pad($number, 4, '0', STR_PAD_LEFT);
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

        // if ($request->has('email') && $request->email !== $supplier->email && Supplier::where('email', $request->email)->exists()) {
        //     return response()->json(['status' => 0, 'message' => 'Email is already taken by another supplier']);
        // }

        // if ($request->has('phone') && $request->phone !== $supplier->phone && Supplier::where('phone', $request->phone)->exists()) {
        //     return response()->json(['status' => 0, 'message' => 'Phone number is already taken by another supplier']);
        // }

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
