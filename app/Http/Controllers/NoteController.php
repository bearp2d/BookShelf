<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Book;
use Gate;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required',
            'is_private' => 'required|boolean',
            'book_id' => 'required|exists:books,id'
        ]);

        // create the note
        $note = new Note;
        $note->forceFill([
            'text' => $request->text,
            'is_private' => $request->is_private,
        ]);

        // append the note to the book
        $book = Book::find($request->book_id);
        $book->notes()->save($note);

        // user should own the note
        $request->user()->notes()->save($note);

        return $note;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'text' => 'required',
            'is_private' => 'required|boolean',
            'book_id' => 'required|exists:books,id'
        ]);

        $note = Note::find($id);
        if (Gate::allows('update-note', $note)) {
            // The current user can update the post...
            $note->update([
                'text' => $request->text,
                'is_private' => $request->is_private
            ]);
        } else {
            $error = ['name' => ['You can not update this note.']];
            return response()->json($error, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $note = Note::find($id);
        if (Gate::allows('delete-note', $note)) {
            // The current user can delete the post...
            $note->delete();
        } else {
            $error = ['name' => ['You can not delete this note.']];
            return response()->json($error, 422);
        }
    }
}
