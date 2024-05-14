<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateBooksTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_update_a_book()
    {
        // Creamos un libro de prueba
        $book = Book::factory()->create();

        // Simulamos una solicitud de actualización con datos nuevos
        $newData = [
            'title' => 'Nuevo título',
            'author' => 'Nuevo autor',
            'genre' => 'Terror',
            'publication_year' => '2006-06-12',
            'description' => 'que higado brou',
            // 'rate' => '3.4',
            // 'likes' => '300'
        ];

        // Hacemos una solicitud PUT al endpoint de actualización
        $response = $this->putJson("/api/books/{$book->id}", $newData);

        // Verificamos que la solicitud haya sido exitosa
        $response->assertStatus(200)->assertJson($newData);

        //validamos que los datos nuevos coincidan con los que estan en la base de datos
        $this->assertDatabaseHas('books', $newData + ['id' => $book->id]);
    }
}
