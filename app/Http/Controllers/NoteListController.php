<?php

namespace App\Http\Controllers;

use App\Models\NoteList;
use Illuminate\Http\Request;

use App\Http\Requests\NoteListFormRequest;

class NoteListController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $listsOfNotes = $user->lists;
        // $listsOfNotes = NoteList::where('user_id', $user->id)->get();
        return response()->json($listsOfNotes);
    }

    public function store(NoteListFormRequest $request)
    {
        $user = $request->user();

        $newNoteList = array_merge($request->all(), ['user_id' => $user->id]);
        $noteList = NoteList::create($newNoteList);
        return response()->json($noteList);
    }

    public function show(Request $request, $id)
    {
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();
        $noteList = NoteList::find($id);


        if ($noteList->user_id == $user->id) {
            return response()->json($noteList);
        } else {
            abort(404, 'Recurso no encontrado');
        }
    }

    public function update(NoteListFormRequest $request,  $id)
    {
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();
        $noteList = NoteList::find($id);

        if (!$noteList->user_id === $user->id) {
            abort(404, 'Recurso no encontrado');
        } else {
            $noteList->update($request->all());
            return response()->json($noteList);
        }
    }

    public function destroy(Request $request, $id)
    {
        // TODO: Validar que el usuario este autorizado (creador/moderador/administrador)
        $user = $request->user();
        $noteList = NoteList::find($id);

        if ($noteList->user_id == $user->id) {
            $noteList->delete();
            return response()->json($noteList);
        } else {
            abort(404, 'Recurso no encontrado');
        }
    }
}