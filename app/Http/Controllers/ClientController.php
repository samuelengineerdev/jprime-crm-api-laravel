<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ClientAccount;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        // $clients = ClientAccount::all();
        $clients = ClientAccount::with('user', 'user.role', 'user.status')->orderBy('id', 'desc')->get();
        return response()->json(['status' => 1, 'clients' => $clients]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        if (empty($data['user']['password']) || empty($data['user']['email']) || empty($data['name'])) {
            return response()->json(['status' => 0, 'message' => 'The email, password and name are requeried']);
        }

        $user = User::where('email', $data['user']['email'])->first();

        if ($user) {
            return response()->json(['status' => 0, 'message' => 'This email is registered']);
        }

        $client = ClientAccount::create($data);
        $user = User::create([
            'email' =>  $data['user']['email'],
            'password' =>  $data['user']['password'],
            'userable_id' => $client->id,
            'status_id' => $data['user']['status_id'],
            'role_id' => 2,
            'userable_type' => ClientAccount::class,
        ]);

        if (!$client) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register client']);
        }

        if (!$user || !$client) {
            return response()->json(['status' => 0, 'message' => 'Error trying to register client']);
        }

        return response()->json(['status' => 1, 'client' => $client, 'message' => 'Client registered successfully'], 201);
    }

    public function show($id)
    {
        $client = ClientAccount::with('user', 'user.role', 'user.status')->find($id);

        if (!$client) {
            return response()->json(['status' => 0, 'message' => 'Client not found']);
        }

        return response()->json(['status' => 1, 'client' => $client]);
    }

    public function update(Request $request)
    {
        $data = $request->all();
        $client = ClientAccount::find($data['id']);
        $user = User::find($data['user']['id']);

        if (!$client || !$user) {
            return response()->json(['status' => 0, 'message' => 'Client not found']);
        }

        $client->update($data);
        $user->update($data['user']);

        if (!$client || !$user) {
            return response()->json(['status' => 0, 'message' => 'Error trying update']);
        }

        return response()->json(['status' => 1, 'client' => $client, 'user' => $user, 'message' => 'Client updated successfully']);
    }

    public function destroy($id)
    {
        $clients = ClientAccount::find($id);

        if (!$clients) {
            return response()->json(['status' => 0, 'message' => 'Client not found'], 404);
        }

        $clients->delete();

        return response()->json(['status' => 1, 'message' => 'Client deleted successfully']);
    }
}
