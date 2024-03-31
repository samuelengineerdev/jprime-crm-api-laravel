<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\ClientEmployeeAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use App\Models\Status;
use App\Models\User;


class ProductController extends Controller
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

        $products = Product::with(['category', 'status'])->where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'products' => $products]);
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

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $product = Product::where('client_user_id', $clientUserId)->where('name', $data['name'])->first();

        if ($product) {
            return response()->json(['status' => 0, 'message' => 'This products is registered']);
        }

        $lastCode = Product::where('client_user_id', $clientUserId)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 4)) + 1;
        $data['code'] = 'PROD' . str_pad($number, 4, '0', STR_PAD_LEFT);

        $product = Product::create($data);

        if (!$product) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register product']);
        }

        return response()->json(['status' => 1, 'product' => $product], 201);
    }

    public function show($id)
    {
        $Product = Product::with(['category', 'status'])->find($id);

        if (!$Product) {
            return response()->json(['status' => 0, 'message' => 'Product not found']);
        }

        return response()->json(['status' => 1, 'product' => $Product]);
    }

    public function update(Request $request, $userCode)
    {
        $data = $request->all();
        $clientUserId = $this->getClientUserId($userCode);

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $product = Product::find($data['id']);

        if (!$product) {
            return response()->json(['status' => 0, 'message' => 'Product not found']);
        }

        if ($request->has('name') && $request->name !== $product->name && Product::where('client_user_id', $clientUserId)->where('name', $request->name)->exists()) {
            return response()->json(['status' => 0, 'message' => 'This name is already taken by another product']);
        }

        $product->update($data);

        if (!$product) {
            return response()->json(['status' => 0, 'message' => 'Error trying update product']);
        }

        return response()->json(['status' => 1, 'product' => $product, 'message' => 'Product updated successfully']);
    }

    public function delete($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['status' => 0, 'message' => 'Product not found'], 404);
        }

        $product->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Product deleted successfully']);
    }

    public function statuses()
    {
        $statuses = Status::where('type', 'PRODUCT')->get();
        return response()->json(['status' => 1, 'statuses' => $statuses]);
    }
}
