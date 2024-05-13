<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteBooksTest extends TestCase
{
    use RefreshDatabase;
    public function test_delete_specific_book(): void
    {
        //creamos un libro de prueba
        $book = Book::factory()->create();

        //borramos el libro que acabamos de crear
        $response = $this->deleteJson("/api/books/{$book->id}");

        //nos aseguramos una respuesta que nos indique que el dato ya no existe
        $response->assertNoContent();
    }
}
