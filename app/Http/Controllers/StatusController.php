<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return response()->json(['status' => 1, 'statuses' => $statuses]);
    }

    public function store(Request $request)
    {
        $statuses = Status::create($request->all());
        return response()->json(['data' => $statuses, 'message' => 'Status creado con éxito'], 201);
    }

    public function show($id)
    {
        $statuses = Status::find($id);

        if (!$statuses) {
            return response()->json(['message' => 'Status no encontrado'], 404);
        }

        return response()->json(['data' => $statuses]);
    }

    public function update(Request $request, $id)
    {
        $statuses = Status::find($id);

        if (!$statuses) {
            return response()->json(['message' => 'Status no encontrado'], 404);
        }

        $statuses->update($request->all());

        return response()->json(['data' => $statuses, 'message' => 'Status actualizado con éxito']);
    }

    public function destroy($id)
    {
        $statuses = Status::find($id);

        if (!$statuses) {
            return response()->json(['message' => 'Status no encontrado'], 404);
        }

        $statuses->delete();

        return response()->json(['message' => 'Status eliminado con éxito']);
    }
}
