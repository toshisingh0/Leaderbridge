<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    // List notes for a lead
    public function index($lead_id)
    {
        $notes = Note::where('lead_id', $lead_id)->with('owner')->get();
        return response()->json($notes);
    }

    // Add a note
    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'content' => 'required|string',
        ]);

        $note = Note::create([
            'lead_id' => $request->lead_id,
            'content' => $request->content,
            'owner_id' => Auth::id(), // logged-in user
        ]);

        return response()->json($note, 201);
    }

    // Update a note
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $note->update($request->only('content'));

        return response()->json($note);
    }

    // Delete a note
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return response()->json(['message' => 'Note deleted']);
    }
}
