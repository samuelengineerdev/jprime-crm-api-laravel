<?php

namespace App\Http\Controllers;

use App\Models\ClientAccount;
use App\Models\ClientEmployeeAccount;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ProductCategory;
use App\Models\User;

class ProductCategoryController extends Controller
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
        $categories = ProductCategory::where('client_user_id', $clientUserId)->where('deleted', 0)->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'categories' => $categories]);
    }

    public function store(Request $request, $userCode)
    {
        $data = $request->all();

        $clientUserId = $this->getClientUserId($userCode);
        $data['client_user_id'] = $clientUserId;

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $categorie = ProductCategory::where('client_user_id', $clientUserId)->where('name', $data['name'])->first();
        if ($categorie) {
            return response()->json(['status' => 0, 'message' => 'This products is registered']);
        }

        $lastCode = ProductCategory::where('client_user_id', $clientUserId)->orderBy('id', 'desc')->pluck('code')->first();
        $number = intval(substr($lastCode, 3)) + 1;
        $data['code'] = 'CAT' . str_pad($number, 4, '0', STR_PAD_LEFT);


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

    public function update(Request $request, $userCode)
    {
        $data = $request->all();
        $clientUserId = $this->getClientUserId($userCode);

        if (!isset($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The field name is required']);
        }

        $categorie = ProductCategory::find($data['id']);

        if (!$categorie) {
            return response()->json(['status' => 0, 'message' => 'Category not found']);
        }

        if ($request->has('name') && $request->name !== $categorie->name && ProductCategory::where('client_user_id', $clientUserId)->where('name', $request->name)->exists()) {
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
