<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\BookRequest;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    public function search(Request $request): JsonResponse
    {
        $searchTerm = $request->query('search');

        // Obtener todos los libros si no hay término de búsqueda
        if (!$searchTerm) {
            $books = Book::all();
        } else {
            // Buscar libros que coincidan con el término de búsqueda en el título o el autor
            $books = Book::where('title', 'like', '%' . $searchTerm . '%')
                ->orWhere('author', 'like', '%' . $searchTerm . '%')
                ->orWhere('genre', 'like', '%' . $searchTerm . '%')
                ->get();
        }



        return response()->json($books, 200);
    }

    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());
        return response()->json($book, 201);
    }

    public function update(BookRequest $request, Book $book): JsonResponse
    {
        $book->update($request->validated());
        return response()->json($book, 200);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book, 200);
    }

    public function destroy(Book $book): JsonResponse
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
