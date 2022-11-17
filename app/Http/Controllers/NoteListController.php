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
        // $listsOfNotes = NoteList::where('user_id', $user->id)->with('notes')->get();
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
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        return response()->json($noteList);
    }

    public function update(NoteListFormRequest $request,  $id)
    {
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        $noteList->update($request->all());
        return response()->json($noteList);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        $noteList->delete();
        return response()->json($noteList);
    }
}
