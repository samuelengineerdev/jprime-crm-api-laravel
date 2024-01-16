<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Sale;
use App\Models\Status;
use App\Models\Product;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\PaymentType;

class SaleController extends Controller
{
    public function index($user)
    {
        $sales = Sale::with(['category', 'status'])->where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'sales' => $sales]);
    }

    public function store(Request $request, $user)
    {
        $data = $request->all();
        $data['user_id'] = $user;

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'message' => 'Error missing value requerid']);
        }

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $sale = Sale::where('user_id', $user)->where('name', $data['name'])->first();
        if ($sale) {
            return response()->json(['status' => 0, 'message' => 'This sales is registered']);
        }

        $lastCode = Sale::where('user_id', $user)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'PROD' . str_pad($number, 3, '0', STR_PAD_LEFT);


        $sale = Sale::create($data);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register sale']);
        }

        return response()->json(['status' => 1, 'sale' => $sale], 201);
    }

    public function show($id)
    {
        $Sale = Sale::with(['category', 'status'])->find($id);

        if (!$Sale) {
            return response()->json(['status' => 0, 'message' => 'Sale not found']);
        }

        return response()->json(['status' => 1, 'sale' => $Sale]);
    }

    public function update(Request $request, $user)
    {
        $data = $request->all();

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'message' => 'Error missing value requerid']);
        }

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $sale = Sale::find($data['id']);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Sale not found']);
        }

        if ($request->has('name') && $request->name !== $sale->name && Sale::where('user_id', $user)->where('name', $request->name)->exists()) {
            return response()->json(['status' => 0, 'message' => 'This name is already taken by another sale']);
        }

        $sale->update($data);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Error trying update sale']);
        }

        return response()->json(['status' => 1, 'sale' => $sale, 'message' => 'Sale updated successfully']);
    }

    public function delete($id)
    {
        $sale = Sale::find($id);

        if (!$sale) {
            return response()->json(['status' => 0, 'message' => 'Sale not found'], 404);
        }

        $sale->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Sale deleted successfully']);
    }

    public function statuses()
    {
        $statuses = Status::where('type', 'SALE')->get();
        return response()->json(['status' => 1, 'statuses' => $statuses]);
    }

    public function getSaleCreationData($user)
    {
        $statuses = Status::where('type', 'SALE')->get();
        $paymentMethods = PaymentMethod::where('type', 'SALE')->get();
        $paymentTypes = PaymentType::where('type', 'SALE')->get();
        $customers = Customer::with('status')->where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();
        $products = Product::with(['category', 'status'])->where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();

        return response()->json(['status' => 1, 'statuses' => $statuses, 'paymentMethods' => $paymentMethods, 'paymentTypes' => $paymentTypes, 'customers' => $customers, 'products' => $products]);
    }
}
