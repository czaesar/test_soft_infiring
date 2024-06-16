<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Jobs\SendAdminNotification;
use App\Models\Note;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): ResourceCollection
    {
        $user_id = Auth::id();
        $note = Note::query()
            ->where('user_id', '=', $user_id)
            ->get();

        return NoteResource::collection($note);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNoteRequest $request): NoteResource
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $note = Note::firstOrCreate($data);

        SendAdminNotification::dispatch($note);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): NoteResource
    {
        $user_id = Auth::id();
        $note = Note::query()
            ->where('user_id', '=', $user_id)
            ->findOrFail($id);

        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, string $id): NoteResource
    {
        $user_id = Auth::id();
        $data = $request->validated();

        $note = Note::query()
            ->where('user_id', '=', $user_id)
            ->findOrFail($id);
        $note->update($data);

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): NoteResource
    {
        $user_id = Auth::id();
        $note = Note::query()
            ->where('user_id', '=', $user_id)
            ->findOrFail($id);
        $note->delete();

        return new NoteResource($note);
    }
}
