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
        $listsOfNotes = NoteList::where('user_id', $user->id)->with('notes')->get();
        return response()->json($listsOfNotes);
    }

    public function store(NoteListFormRequest $request)
    {
        $user = $request->user();

        if ($request->only('title') == "All Notes (default)") {
            abort(403, "Invalid name for a list of notes");
        }

        $newNoteList = array_merge($request->all(), ['user_id' => $user->id]);
        $noteList = NoteList::create($newNoteList);
        return response()->json($noteList);
    }

    public function show(Request $request, $id)
    {
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        return response()->json($noteList->with('notes')->where('id', $noteList->id)->get()[0]);
    }

    public function update(NoteListFormRequest $request,  $id)
    {
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        if ($noteList->title == "All Notes (default)" && $noteList->description ==  "Note list created by default") {
            abort(403, "It is not possible to update the list of notes by default");
        }

        $noteList->update($request->all());
        return response()->json($noteList);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $noteList = NoteList::find($id);

        $this->authorize('isAuthorized', [$noteList, $user]);

        if ($noteList->title == "All Notes (default)" && $noteList->description ==  "Note list created by default") {
            abort(403, "It is not possible to delete the list of notes by default");
        }

        $noteList->delete();
        return response()->json($noteList);
    }
}
