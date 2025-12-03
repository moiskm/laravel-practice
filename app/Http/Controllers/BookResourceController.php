<?php

namespace App\Http\Controllers;

use App\Models\BookResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BookResourceController extends Controller
{
    /**
     * Muestra una lista de recursos asociados a libros.
     */
    public function index(): JsonResponse
    {
        $bookResources = BookResource::with('book')->get();
        
        return response()->json([
            'success' => true,
            'data' => $bookResources
        ], 200);
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     */
    public function create()
    {
        // No implementado para API 
    }

    /**
     * Almacena un nuevo BookResource en la bd.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'type' => 'required|in:pdf,video,audio,game',
            'title' => 'required|string|max:255',
            'file_path' => 'nullable|string',
            'external_url' => 'nullable|url',
            'duration_seconds' => 'nullable|integer|min:0',
            'display_order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        $bookResource = BookResource::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book resource created successfully',
            'data' => $bookResource->load('book')
        ], 201);
    }

    /**
     * Muestra un recurso especifico

     */
    public function show(BookResource $bookResource): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $bookResource->load('book'),
        ], 200);
    }

    /**
     * Actualiza el recurso especificado

     */
    public function update(Request $request, BookResource $bookResource): JsonResponse
    {
        $validated = $request->validate([
            'type' => 'sometimes|required|in:pdf,video,audio,game',
            'title' => 'sometimes|required|string|max:255',
            'file_path' => 'nullable|string',
            'external_url' => 'nullable|url',
            'duration_seconds' => 'nullable|integer|min:0',
            'display_order' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'metadata' => 'nullable|array',
            'is_active' => 'nullable|boolean',
        ]);

        // Aplica los cambioss
        $bookResource->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Book resource updated successfully',
            'data' => $bookResource->load('book'),
        ], 200);
    }

    /**
     * Elimina el recurso especificado de la bd
     */
    public function destroy(BookResource $bookResource): JsonResponse
    {
        // Realiza el borrado
        $bookResource->delete();

        return response()->json([
            'success' => true,
            'message' => 'Book resource deleted successfully'
        ], 200);
    }
}
