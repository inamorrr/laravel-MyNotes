<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Note::where('user_id', Auth::id());

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $notes = $query->latest()->get();
        return view('notes.index', compact('notes'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('notes.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required', // pastikan wajib
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|file',
        ]);


        $note = new Note();
        $note->title = $request->title;
        $note->content = $request->content;
        $note->category_id = $request->category_id;
        $note->user_id = Auth::id();

        if ($request->hasFile('file')) {
            $note->file = $request->file('file')->store('uploads', 'public');
        }

        $note->save();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return view('notes.show', compact('note'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $this->authorize('update', $note);

        $categories = Category::all();
        return view('notes.edit', compact('note', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $note = Note::findOrFail($id);
        $this->authorize('update', $note);

        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $note->title = $request->title;
        $note->content = $request->content;
        $note->category_id = $request->category_id;

        if ($request->hasFile('file')) {
            if ($note->file) {
                Storage::disk('public')->delete($note->file);
            }
            $note->file = $request->file('file')->store('uploads', 'public');
        }

        $note->save();
        return redirect()->route('notes.index')->with('success', 'Catatan berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        $this->authorize('delete', $note);
        if ($note->file) {
            Storage::disk('public')->delete($note->file);
        }
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Catatan dihapus.');
    }



    public function __construct()
    {

        $this->middleware('auth');

    }
}
