<?php

namespace Tests\Feature\Books;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreBooksTest extends TestCase
{
    use RefreshDatabase;

    public function test_stores_a_book(): void
    {
        // Simulamos los datos de un libro
        $bookData = [
            'title' => 'Título del Libro',
            'author' => 'Autor del Libro',
            'genre' => 'Género del Libro',
            'publication_year' => '2022-05-12',
            'description' => 'Descripción del Libro',
            'rate' => 4.5,
            'likes' => 100
        ];

        // Hacemos una solicitud HTTP POST para almacenar el libro
        $response = $this->postJson('/api/books', $bookData);

        // Aseguramos que la solicitud se haya realizado con éxito (código de estado 201)
        $response->assertStatus(201);

        // Verificamos que el libro haya sido almacenado en la base de datos
        $this->assertDatabaseHas('books', $bookData);

        // Verificamos que la respuesta contiene los datos del libro recién creado
        $response->assertJsonFragment($bookData);
    }
}
