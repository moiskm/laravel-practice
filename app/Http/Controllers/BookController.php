<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{

    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Book::all()
        ], 200);
    }


    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer',
            'subject' => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $book = Book::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book created successfully.',
            'data' => $book
        ], 201);
    }


    public function show(Book $book): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $book
        ], 200);
    }


    public function update(Request $request, Book $book): JsonResponse
    {
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'isbn' => 'nullable|string|max:20',
            'author' => 'nullable|string|max:255',
            'publisher' => 'nullable|string|max:255',
            'edition' => 'nullable|string|max:255',
            'publication_year' => 'nullable|integer',
            'subject' => 'nullable|string|max:255',
            'educational_level' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'cover_image' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $book->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book updated successfully.',
            'data' => $book
        ], 200);
    }


    public function destroy(Book $book): JsonResponse
    {
        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully.'
        ], 200);
    }
}
