<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

use App\Http\Requests\NoteFormRequest;

class NoteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $notes = $user->notes;
        // $notes = Note::where('user_id', $user->id)->get();
        return response()->json($notes);
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
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();

        if ($note->user_id == $user->id) {
            return response()->json($note);
        } else {
            abort(404, 'Recurso no encontrado');
        }
    }


    public function update(NoteFormRequest $request, Note $note)
    {
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();

        if (!$note->user_id == $user->id) {
            abort(404, 'Recurso no encontrado');
        } else {
            $note->update($request->all());
            return response()->json($note);
        }
    }


    public function destroy(Request $request, Note $note)
    {
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();

        if ($note->user_id == $user->id) {
            $note->delete();
            return response()->json($note);
        } else {
            abort(404, 'Recurso no encontrado');
        }
    }
}
