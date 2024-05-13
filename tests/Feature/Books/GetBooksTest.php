<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetBooksTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_all_books(): void
    {
        //crear 5 datos de prueba
        $books = Book::factory(5)->create();

        //capturar los datos de atraves de la ruta
        $response = $this->getJson('/api/books');

        //aseruarse que retorna el codigo de estado de respuesta correcto
        $response->assertStatus(200);

        //devuelve los datos en formato json
        $response->assertJson($books->toArray());
    }
}
