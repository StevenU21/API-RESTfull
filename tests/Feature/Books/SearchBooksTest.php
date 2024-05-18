<?php

namespace Tests\Feature\Books;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchBooksTest extends TestCase
{
    use RefreshDatabase;

    // Array asociativo con los datos de ambos libros
    public $booksData = [
        [
            'title' => 'El señor de los anillos',
            'author' => 'J.R.R. Tolkien',
            'genre' => 'Fantasía',
            'publication_year' => '1954-07-29',
            'description' => 'Una épica historia de aventuras en un mundo de fantasía.',
            'rate' => 4.5,
            'likes' => 100
        ],
        [
            'title' => 'Harry Potter',
            'author' => 'J.K. Rowling',
            'genre' => 'Fantasía',
            'publication_year' => '1997-06-26',
            'description' => 'La historia del joven mago Harry Potter y sus aventuras en Hogwarts.',
            'rate' => 4.8,
            'likes' => 150
        ]
    ];

    public function test_it_can_search_books_by_author()
    {
        // Iteramos sobre el array y creamos los libros en la base de datos
        foreach ($this->booksData as $bookData) {
            Book::create($bookData);
        }

        // Realizar la búsqueda por el autor
        $response = $this->get('/api/books/search?search=anillos');

        // Comprobar que se devuelven los libros correctos
        $response->assertJson([
            ['title' => 'El señor de los anillos', 'author' => 'J.R.R. Tolkien'],
        ]);
    }

    public function test_it_can_search_books_by_title()
    {
        // Iteramos sobre el array y creamos los libros en la base de datos
        foreach ($this->booksData as $bookData) {
            Book::create($bookData);
        }

        // Realizar la búsqueda por título
        $response = $this->get('/api/books/search?search=anillos');

        // Comprobar que se devuelven los libros correctos
        $response->assertJson([
            ['title' => 'El señor de los anillos', 'author' => 'J.R.R. Tolkien'],
        ]);
    }

    public function test_it_can_search_books_by_genre()
    {
        // Iteramos sobre el array y creamos los libros en la base de datos
        foreach ($this->booksData as $bookData) {
            Book::create($bookData);
        }

        // Realizar la búsqueda por  el género
        $response = $this->get('/api/books/search?search=Fantasía');

        // Comprobar que se devuelven los libros correctos
        $response->assertJson([
            ['title' => 'El señor de los anillos', 'author' => 'J.R.R. Tolkien', 'genre' => 'Fantasía'],
        ]);
    }

    public function test_search_without_search_terms()
    {
        // Crea algunos libros para probar
        $books = Book::factory()->count(3)->create();

        // Realiza la solicitud al endpoint de búsqueda sin un término de búsqueda
        $response = $this->get('/api/books/search');

        // Verifica que la solicitud se haya realizado correctamente
        $response->assertStatus(200);

        // Verifica que todos los libros se devuelvan en la respuesta
        $response->assertJsonCount(count($books));
    }

    public function test_search_with_no_results()
    {
        // Realizar la búsqueda con un término que no coincida con ningún libro
        $response = $this->get('/api/books/search?search=NoMatch');

        // Verificar que la solicitud se haya realizado correctamente
        $response->assertStatus(200);

        // Verificar que la respuesta indique que no se encontraron resultados
        $response->assertJsonCount(0);
    }
}
