<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

use App\Http\Requests\NoteFormRequest;
use App\Models\NoteList;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        // $notes = $user->notes;
        $notes = Note::where('user_id', $user->id)->with('lists:id,title')->get();
        return response()->json($notes);
    }

    public function getNotesByIdYTVideo(Request $request, $idYTVideo)
    {
        if (!is_string($idYTVideo) && !empty($idYTVideo)) {
            abort(404, 'No existe el idYTVideo en DB');
        }
        $user = $request->user();
        $notes = Note::where('user_id', $user->id)->where('idYTVideo', $idYTVideo)->with('lists:id,title')->get();
        return response()->json($notes);
    }

    public function addNoteInNoteList(Request $request, Note $note, NoteList $noteList)
    {
        if (!$note && !$noteList) {
            abort(400);
        }
        $user = $request->user();

        if ($user->id !== $note->user_id || $user->id !== $noteList->user_id) {
            abort(404, 'Recurso no encontrado');
        }

        foreach ($note->lists as $list) {
            if ($list->id == $noteList->id) {
                return response('', 200);
            }
        }

        $note->lists()->attach($noteList->id);

        return response('', 200);
    }

    public function deleteNoteInNoteList(Request $request, Note $note, NoteList $noteList)
    {
        if (!$note && !$noteList) {
            abort(400);
        }
        $user = $request->user();

        if ($user->id !== $note->user_id || $user->id !== $noteList->user_id) {
            abort(404, 'Recurso no encontrado');
        }

        $note->lists()->detach($noteList->id);

        return response('', 200);
    }

    public function store(NoteFormRequest $request)
    {
        $user = $request->user();

        $newNote = array_merge($request->all(), ['user_id' => $user->id]);
        $note = Note::create($newNote);

        return response()->json($note);
    }

    public function show(Request $request, Note $note)
    {
        $user = $request->user();

        $this->authorize('isAuthorized', [$note, $user]);

        return response()->json($note);
    }


    public function update(NoteFormRequest $request, Note $note)
    {
        $user = $request->user();

        $this->authorize('isAuthorized', [$note, $user]);

        $note->update($request->all());
        return response()->json($note);
    }


    public function destroy(Request $request, Note $note)
    {
        $user = $request->user();

        $this->authorize('isAuthorized', [$note, $user]);

        $note->delete();
        return response()->json($note);
    }
}
