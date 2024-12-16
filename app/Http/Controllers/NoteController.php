<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Client;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Client $client)
    {
        // Fetch all notes associated with the client
        return response()->json($client->notes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string|max:255',
        ]);

        // Create a new sticky note
        $note = new Note();
        $note->client_id = $client->id;
        $note->user_id = auth()->id(); // Store the ID of the logged-in user
        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        // return response()->json(['message' => 'Note added successfully.']);
        return redirect()->back()->with('success', 'Note saved successfully!');
    }


    public function getNotes(Client $client)
    {
        $notes = Note::where('client_id', $client->id)
            ->where(function ($query) {
                // Show notes created by the logged-in user or admin
                $query->where('user_id', auth()->id())
                    ->orWhereHas('user', function ($query) {
                    $query->where('role', 'Admin');  // Assuming the user has a role column
                });
            })
            ->get();

        return response()->json($notes);
    }


    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $note->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Note updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        // Check if the current user is authorized to delete the note
        if ($note->user_id !== auth()->id() && !auth()->user()->hasRole('Admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $note->delete();

        return response()->json(['success' => true, 'message' => 'Note deleted successfully.']);
    }
}
