<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = \App\Models\Book::all();

        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'isbn'              => 'required|string|max:20',
            'author'            => 'required|string|max:255',
            'publisher'         => 'nullable|string|max:255',
            'edition'           => 'nullable|string|max:50',
            'publication_year'  => 'nullable|integer',
            'subject'           => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:100',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric',
            'stock'             => 'required|integer',
            'cover_image'       => 'nullable|string',
            'is_active'         => 'boolean',
        ]);

        Book::create($validated);


        return redirect()->route('books.index')->with('success', 'Libro creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $book = Book::findOrFail($book->id);
        return view('books.edit', compact('book'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|string|max:255',
            'isbn'              => 'required|string|max:20',
            'author'            => 'required|string|max:255',
            'publisher'         => 'nullable|string|max:255',
            'edition'           => 'nullable|string|max:50',
            'publication_year'  => 'nullable|integer',
            'subject'           => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:100',
            'description'       => 'nullable|string',
            'price'             => 'required|numeric',
            'stock'             => 'required|integer',
            'cover_image'       => 'nullable|string',
            'is_active'         => 'boolean',
        ]);

        $book->update($validated);
        return redirect()->route('books.index')->with('success', 'Libro actualizado con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Libro eliminado con éxito.');
    }
}
