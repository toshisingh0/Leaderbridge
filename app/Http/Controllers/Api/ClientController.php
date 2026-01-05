<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Events\ClientCreated; 

class ClientController extends Controller
{


   public function index(Request $request)
   {
    $clients = Client::with('owner')
        ->where('owner_id', auth()->id())

        // 🔍 SEARCH (name, email, company)
        ->when($request->search, function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                $query->where('name', 'like', "%{$request->search}%")
                      ->orWhere('email', 'like', "%{$request->search}%")
                      ->orWhere('company', 'like', "%{$request->search}%");
            });
        })

        // 🎯 SOURCE FILTER (Facebook, Website, etc.)
        ->when($request->source, function ($q) use ($request) {
            $q->where('source', $request->source);
        })

        ->latest()
        ->paginate(10);

    return response()->json([
        'status' => true,
        'data'   => $clients
    ]);
    }




    public function store(Request $request)
    {
    $data = $request->validate([
        'name'    => 'required|string|max:255',
        'company' => 'required|string|max:255',
        'email'   => 'required|email|unique:clients,email',
        'phone'   => 'nullable|string|max:20',
        'source'  => 'nullable|string|max:255',
        'notes'   => 'required|string|max:255',
    ]);

    // ✅ Logged-in user is the owner
    $data['owner_id'] = auth()->id();

    $client = Client::create($data);

    event(new ClientCreated($client)); 

    return response()->json([
        'message' => 'Client created successfully',
        'data'    => $client->load('owner')
    ], 201);
    }


    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return response()->json([
            'status' => true,
            'data' => $client
        ]);
    }

    public function show(Client $client)
    {
        // ✅ Security check
        if ($client->owner_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return new ClientResource($client->load('owner'));
    }

    public function update(Request $request, Client $client)
    {
        if ($client->owner_id !== auth()->id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'email'   => 'required|email|unique:clients,email,' . $client->id,
            'phone'   => 'nullable|string|max:20',
            'source'  => 'nullable|string|max:255',
            'notes'   => 'required|string|max:255',
        ]);

        $client->update($data);

        return new ClientResource($client->load('owner'));
    }

    public function destroy(Client $client)
    {
        // ✅ Ensure only owner can delete
        if ($client->owner_id !== auth()->id()) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $client->delete();

        return response()->json([
            'status' => true,
            'message' => 'Client deleted successfully'
        ]);
    }






}
