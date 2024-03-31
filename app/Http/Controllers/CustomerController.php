<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\ClientEmployeeAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Customer;
use App\Models\Status;
use App\Models\User;
use Carbon\Carbon;

class CustomerController extends Controller
{
    public function getClientUserId($userCode)
    {
        if (strpos($userCode, 'CA') === 0) {
            $clientAccout = ClientAccount::where('code', $userCode)->first();
            $clientUser = User::where('userable_id', $clientAccout->id)->first();
            $clientUserId = $clientUser->id;
        } elseif (strpos($userCode, 'CEA') === 0) {
            $clientEmployee = ClientEmployeeAccount::where('code', $userCode)->first();
            $clientUserId = $clientEmployee ? $clientEmployee->client_user_id : null;
        } else {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        // Verificar si se encontró un usuario válido
        if (!$clientUserId) {
            return response()->json(['status' => 0, 'message' => 'Error: user not found']);
        }

        return $clientUserId;
    }


    public function index($userCode)
    {
        $clientUserId = $this->getClientUserId($userCode);
        $customers = Customer::with('status')->where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'customers' => $customers]);
    }

    public function store(Request $request, $userCode)
    {
        $data = $request->all();
        $clientUserId = $this->getClientUserId($userCode);
        $data['client_user_id'] = $clientUserId;

        if (!isset($data['full_name']) || !isset($data['email']) || !isset($data['phone'])) {
            return response()->json(['status' => 0, 'message' => 'The fields name, email and phone are required']);
        }

        $customer = Customer::where('email', $data['email'])->first();
        if ($customer) {
            return response()->json(['status' => 0, 'message' => 'This email is registered']);
        }

        $customer = Customer::where('phone', $data['phone'])->first();
        if ($customer) {
            return response()->json(['status' => 0, 'message' => 'This phone is registered']);
        }

        $lastCode = Customer::where('client_user_id', $clientUserId)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'CUS' . str_pad($number, 4, '0', STR_PAD_LEFT);
        $data['registration_date'] = Carbon::now()->toDateString();


        $customer = Customer::create($data);

        if (!$customer) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register customer']);
        }

        return response()->json(['status' => 1, 'customer' => $customer], 201);
    }

    public function show($id)
    {
        $customer = Customer::with('status')->find($id);

        if (!$customer) {
            return response()->json(['status' => 0, 'message' => 'Customer not found']);
        }

        return response()->json(['status' => 1, 'customer' => $customer]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $customer = Customer::find($data['id']);

        if (!$customer) {
            return response()->json(['status' => 0, 'message' => 'Customer not found']);
        }

        if ($request->has('email') && $request->email !== $customer->email && Customer::where('email', $request->email)->exists()) {
            return response()->json(['status' => 0, 'message' => 'Email is already taken by another customer']);
        }

        if ($request->has('phone') && $request->phone !== $customer->phone && Customer::where('phone', $request->phone)->exists()) {
            return response()->json(['status' => 0, 'message' => 'Phone number is already taken by another customer']);
        }

        $data['last_purchase_date'] = Carbon::now()->toDateString();
        $customer->update($data);

        if (!$customer) {
            return response()->json(['status' => 0, 'message' => 'Error trying update customer']);
        }

        return response()->json(['status' => 1, 'data' => $customer, 'message' => 'Customer updated successfully']);
    }

    public function delete($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json(['status' => 0, 'message' => 'Customer not found'], 404);
        }

        $customer->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Customer deleted successfully']);
    }

    public function statuses()
    {
        $statuses = Status::where('type', 'ACTIVE-INACTIVE')->get();
        return response()->json(['status' => 1, 'statuses' => $statuses]);
    }
}
