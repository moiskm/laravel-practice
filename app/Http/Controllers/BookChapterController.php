<?php

namespace App\Http\Controllers;

//Importación de clases

use App\Models\BookChapter;//Importamos el modelo BookResource

use Illuminate\Http\Request;//POST/PUT - JSON

use Illuminate\Http\JsonResponse;//JSON

class BookChapterController extends Controller

{

    //Listar capítulos
    public function index(): JsonResponse
    {
        $chapters = BookChapter::with(['book', 'parent', 'children'])->get();

        return response()->json([
            'success' => true,
            'data' => $chapters
        ], 200);
    }


    public function create()
    {   }

    //Crear un capítulo
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'parent_id' => 'nullable|exists:book_chapters,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $chapter = BookChapter::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book chapter created successfully',
            'data' => $chapter->load(['book', 'parent', 'children'])
        ], 201);
    }

    //Ver un capítulo específico
    public function show(BookChapter $bookChapter): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $bookChapter->load(['book', 'parent', 'children'])
        ], 200);
    }

    //Actualizar un capítulo
    public function update(Request $request, BookChapter $bookChapter): JsonResponse
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:book_chapters,id|not_in:' . $bookChapter->id,
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:50',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $bookChapter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book chapter updated successfully',
            'data' => $bookChapter->load(['book', 'parent', 'children']),
        ], 200);
    }

    //Eliminar un capítulo
    public function destroy(BookChapter $bookChapter): JsonResponse
    {
        $bookChapter->children()->delete();

        $bookChapter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book chapter and its children deleted successfully'
        ], 200);
    }
}
