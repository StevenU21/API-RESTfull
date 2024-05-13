<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowBooksTest extends TestCase
{
    use RefreshDatabase;

    public function test_show_specific_book(): void
    {
        //creamos un libros de prueba
        $book = Book::factory()->create();

        //capturamos los datos de un libro en especifico
        $response = $this->getJson("/api/books/{$book->id}");
        //nos aseguramos de esperar una respuesta correcta
        $response->assertStatus(200);
        //ahora devolvemos el valor como un json
        $response->assertJson($book->toArray());
    }

    public function test_return_response_404_if_book_is_empty(): void
    {
        //escenario en donde esta esta buscando en una ruta donde no existe el registro
        $response = $this->getJson('/api/books/1000');
        //esperamos un mensaje de respuesta de no encontrado
        $response->assertStatus(404);
    }
}
