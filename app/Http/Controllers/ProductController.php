<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Product;
use App\Models\Status;


class ProductController extends Controller
{
    public function index($user)
    {
        $products = Product::with(['category', 'status'])->where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'products' => $products]);
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

        $product = Product::where('user_id', $user)->where('name', $data['name'])->first();
        if ($product) {
            return response()->json(['status' => 0, 'message' => 'This products is registered']);
        }

        $lastCode = Product::where('user_id', $user)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'PROD' . str_pad($number, 3, '0', STR_PAD_LEFT);


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

    public function update(Request $request, $user)
    {
        $data = $request->all();

        if (!isset($data['user_id'])) {
            return response()->json(['status' => 0, 'message' => 'Error missing value requerid']);
        }

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $product = Product::find($data['id']);

        if (!$product) {
            return response()->json(['status' => 0, 'message' => 'Product not found']);
        }

        if ($request->has('name') && $request->name !== $product->name && Product::where('user_id', $user)->where('name', $request->name)->exists()) {
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
