<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    public function index($user)
    {
        $categories = ProductCategory::where('user_id', $user)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'categories' => $categories]);
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

        $categorie = ProductCategory::where('user_id', $user)->where('name', $data['name'])->first();
        if ($categorie) {
            return response()->json(['status' => 0, 'message' => 'This products is registered']);
        }

        $lastCode = ProductCategory::where('user_id', $user)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'CAT' . str_pad($number, 3, '0', STR_PAD_LEFT);


        $categorie = ProductCategory::create($data);

        if (!$categorie) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register categorie']);
        }

        return response()->json(['status' => 1, 'categorie' => $categorie], 201);
    }

    public function show($id)
    {
        $category = ProductCategory::find($id);

        if (!$category) {
            return response()->json(['status' => 0, 'message' => 'Category not found']);
        }

        return response()->json(['status' => 1, 'category' => $category]);
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

        $categorie = ProductCategory::find($data['id']);

        if (!$categorie) {
            return response()->json(['status' => 0, 'message' => 'Category not found']);
        }

        if ($request->has('name') && $request->name !== $categorie->name && ProductCategory::where('user_id', $user)->where('name', $request->name)->exists()) {
            return response()->json(['status' => 0, 'message' => 'This name is already taken by another categorie']);
        }

        $categorie->update($data);

        if (!$categorie) {
            return response()->json(['status' => 0, 'message' => 'Error trying update categorie']);
        }

        return response()->json(['status' => 1, 'data' => $categorie, 'message' => 'ProductCategory updated successfully']);
    }

    public function delete($id)
    {
        $categorie = ProductCategory::find($id);

        if (!$categorie) {
            return response()->json(['status' => 0, 'message' => 'Category not found'], 404);
        }

        $categorie->update(['deleted' => 1]);

        return response()->json(['status' => 1, 'message' => 'Category deleted successfully']);
    }
}
