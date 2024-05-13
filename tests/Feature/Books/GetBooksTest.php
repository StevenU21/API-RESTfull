<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Tests\TestCase;

class GetBooksTest extends TestCase
{
    public function test_get_books(): void
    {
        //Capturar todos los libros
        $books = Book::all();

        //Si esta vacio llenar con datos de prueba
        if ($books->isEmpty()) {
            $books = Book::factory(5)->create();
        }

        //capturar los datos de atraves de la ruta
        $response = $this->getJson('/api/books');
        //aseruarse que retorna el codigo de estado de respuesta correcto
        $response->assertStatus(200);

        //devuelve los datos en formato json
        $response->assertJson($books->toArray());
    }
}
