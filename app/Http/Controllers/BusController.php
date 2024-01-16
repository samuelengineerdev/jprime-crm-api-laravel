<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Bus;

class BusController extends Controller
{
    public function index()
    {
        // $buses = Bus::all();
        $buses = Bus::with('status')->orderBy('created_at', 'desc')->get();
        return response()->json(['status' => 1, 'buses' => $buses]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['bus_plate'])) {
            return response()->json(['status' => 0, 'message' => 'You must enter the bus plate']);
        }

        $bus = Bus::where('bus_plate', $data['bus_plate'])->first();

        if ($bus) {
            return response()->json(['status' => 0, 'message' => 'This plate is registered']);
        }

        $bus = Bus::create($data);

        if (!$bus) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register bus']);
        }

        return response()->json(['status' => 1, 'bus' => $bus], 201);
    }

    public function show($id)
    {
        $buses = Bus::with('status')->find($id);

        if (!$buses) {
            return response()->json(['status' => 0, 'message' => 'Bus no encontrado'], 404);
        }

        return response()->json(['status' => 1, 'data' => $buses]);
    }

    public function update(Request $request, $id)
    {
        $buses = Bus::find($id);

        if (!$buses) {
            return response()->json(['message' => 'Bus no encontrado'], 404);
        }

        $buses->update($request->all());

        if (!$buses) {
            return response()->json(['status' => 0, 'message' => 'Error'], 404);
        }

        return response()->json(['status' => 1, 'data' => $buses, 'message' => 'Bus actualizada con éxito']);
    }

    public function destroy($id)
    {
        $buses = Bus::find($id);

        if (!$buses) {
            return response()->json(['status' => 0, 'message' => 'Bus no encontrado'], 404);
        }

        $buses->delete();

        return response()->json(['status' => 1, 'message' => 'Bus eliminado con éxito']);
    }
}
