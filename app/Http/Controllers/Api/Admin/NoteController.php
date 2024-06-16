<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Note\CreateNoteRequest;
use App\Http\Requests\Note\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
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

        //можно всю логику вынести в сервис, и если бы я писал реальное приложение, так бы и сделал как в примере
        //AuthController, но извините, это у меня и так 3-е тестовое которое нужно выполнить))
        $note = Note::all();

        return NoteResource::collection($note);

        //в теории можно было сделать всё в одном контроллере
        //без разделения на разные, и просто сделать через запрос
        //        $user = Auth::user();
        //
        //        Note::when($user->role_id == 2, function ($query) use ($user) {
        //            return $query->where('user_id', $user->id);
        //        })->get();
        //но так лучше не делать и разделять ибо в буд в теории логика может быть разной при масштабировании логки)))))
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateNoteRequest $request): NoteResource
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();

        $note = Note::firstOrCreate($data);

        return new NoteResource($note);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): NoteResource
    {
        $note = Note::findOrFail($id);

        return new NoteResource($note);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, string $id): NoteResource
    {
        $data = $request->validated();

        $note = Note::findOrFail($id);
        $note->update($data);

        return new NoteResource($note);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): NoteResource
    {
        $note = Note::findOrFail($id);
        $note->delete();

        return new NoteResource($note);
    }
}
