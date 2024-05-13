<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    public function index(): JsonResponse
    {
        $books = Book::all();
        return response()->json($books, 200);
    }

    public function show(Book $book): JsonResponse
    {
        return response()->json($book, 200);
    }
}
