<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // adjust for API token routes as needed
    }

    // List with search, sort, pagination
    public function index(Request $request)
    {
        $query = Client::query();

        // search
        if ($q = $request->input('q')) {
            $query->where(function($q2) use ($q) {
                $q2->where('name', 'like', "%{$q}%")
                   ->orWhere('email', 'like', "%{$q}%")
                   ->orWhere('company', 'like', "%{$q}%")
                   ->orWhere('phone', 'like', "%{$q}%");
            });
        }

        // filter by owner
        if ($owner = $request->input('owner_id')) {
            $query->where('owner_id', $owner);
        }

        // sort
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('dir', 'desc');
        $query->orderBy($sort, $direction);

        $perPage = (int) $request->input('per_page', 6);
        $clients = $query->paginate($perPage)->appends($request->query());

        if ($request->is('api/*')) {
            return ClientResource::collection($clients)->additional(['meta' => [
                'total' => $clients->total(),
                'per_page' => $clients->perPage(),
            ]]);
        }

        return view('clients.index', compact('clients'));
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->validated();
        $client = Client::create($data);

        if ($request->wantsJson()) {
            return new ClientResource($client);
        }

        return redirect()->route('clients.show', $client)->with('success', 'Client created.');
    }

    public function show(Request $request, Client $client)
    {
        if ($request->wantsJson()) {
            return new ClientResource($client->load('owner'));
        }

        return view('clients.show', compact('client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->validated());

        // Always return JSON for API
        return response()->json([
            'message' => 'Client updated successfully',
            'data' => new ClientResource($client)
        ], 200);
    }


     public function destroy(Client $client)
    {
        $client->delete(); // soft delete या hard delete

        return response()->json([
            'message' => 'Client deleted successfully'
        ], 200);
    }

    // Restore (if soft-deleted)
    public function restore($id)
    {
        $client = Client::withTrashed()->findOrFail($id);
        $client->restore();

        return redirect()->route('clients.show', $client)->with('success', 'Client restored.');
    }
}
