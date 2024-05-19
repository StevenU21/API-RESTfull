<?php

namespace Tests\Unit;

use App\Http\Requests\Books\BookRequest;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class BookRequestTest extends TestCase
{
    public function test_the_correct_validation_rules()
    {
        $request = new BookRequest();

        $rules = $request->rules();

        $this->assertEquals([
            'title' => ['required', 'min:6', 'max:60', 'unique:books,title,except,id'],
            'author' => ['required', 'min:3', 'max:30'],
            'genre' => ['required', 'min:6', 'max:20'],
            'publication_year' => ['required', 'date'],
            'description' => ['required', 'min:3', 'max:300'],
            'rate' => ['numeric'],
            'likes' => ['numeric']
        ], $rules);
    }

    public function test_title__min_validation_works()
    {
        // Crear un título que no cumpla con las reglas de validación
        $title = 'abc'; // Menos de 6 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['title' => $title], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    public function test_title_max_validation_works()
    {
        // Crear un título que no cumpla con las reglas de validación
        $title = 'abcdefghijklmnopqrstuvwxyza1b1c1d1e1f1g1h1i1j1k1l1m1n1o1p1k1r1s1t1u1v1w1x1y1z1'; // Mas de 60 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['title' => $title], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    public function test_title_required_validation_works()
    {
        // Crear un título que no cumpla con las reglas de validación
        $title = ''; // Sin título

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['title' => $title], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    public function test_author_required_validation_works()
    {
        // Crear un autor que no cumpla con las reglas de validación
        $author = ''; // Sin nombre de autor

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['author' => $author], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('title', $validator->errors()->toArray());
    }

    public function test_author_min_validation_works()
    {
        // Crear un autor que no cumpla con las reglas de validación
        $author = 'Jo'; // Menos de 3 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['author' => $author], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('author', $validator->errors()->toArray());
    }

    public function test_author_max_validation_works()
    {
        // Crear un autor que no cumpla con las reglas de validación
        $author = 'Johannes Chrysostomus Wolfgangus Theophilus Mozart'; // Menos de 3 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['author' => $author], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('author', $validator->errors()->toArray());
    }

    public function test_genre_required_validation_works()
    {
        // Crear un genero que no cumpla con las reglas de validación
        $genre = ''; // Sin género

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['genre' => $genre], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('genre', $validator->errors()->toArray());
    }

    public function test_genre_min_validation_works()
    {
        // Crear un genero que no cumpla con las reglas de validación
        $genre = 'Home'; // Menos de 6 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['genre' => $genre], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('genre', $validator->errors()->toArray());
    }

    public function test_genre_max_validation_works()
    {
        // Crear un genero que no cumpla con las reglas de validación
        $genre = 'El genero de este campo es demaciado largo porque no se puede describir'; // Mas de 20 caracteres

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['genre' => $genre], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('genre', $validator->errors()->toArray());
    }

    public function test_publication_year_required_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $publication_year = ''; // Sin año de publicación 

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['publication_year' => $publication_year], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('publication_year', $validator->errors()->toArray());
    }

    public function test_publication_year_date_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $publication_year = 'Diesiocho de mayo de dos mil veinte y cuatro'; // Fecha no válida

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['publication_year' => $publication_year], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('publication_year', $validator->errors()->toArray());
    }

    public function test_description_required_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $description = ''; // Sin descripción

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['description' => $description], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }

    public function test_description_min_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $description = 'Si'; // Menos de 3 caracteres 

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['description' => $description], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }

    public function test_description_max_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $description = 'Wolfgang Amadeus Mozart nació el 27 de enero de 1756 en Salzburgo, en la actual Austria, que en esa época era un arzobispado independiente del Sacro Imperio Romano Germánico. Fue el último hijo de Leopold Mozart, músico al servicio del príncipe arzobispo de Salzburgo. Leopold era el segundo maestro de capilla en la corte del arzobispo aunque fue un experimentado profesor. Su madre se llamaba Anna Maria Pertl. Debido a la altísima mortalidad infantil en la Europa de la época, de los siete hijos que tuvo el matrimonio solo sobrevivieron Maria Anna, apodada cariñosamente Nannerl, y Wolfgang Amadeus. Fue bautizado en la catedral de San Ruperto el día después de su nacimiento con los nombres de Joannes Chrysostomus Wolfgangus Theophilus Mozart; a lo largo de su vida firmaría con diversas variaciones sobre su nombre original, siendo una de las más recurrentes «Wolfgang Amadè Mozart».'; // Mas de 300 caracteres 

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['description' => $description], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('description', $validator->errors()->toArray());
    }

    public function test_rate_numeric_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $rate = 'Cinco'; // No es un número

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['rate' => $rate], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación
        $this->assertArrayHasKey('rate', $validator->errors()->toArray());
    }

    public function test_likes_numeric_validation_works()
    {
        // Crear una fecha que no cumpla con las reglas de validación
        $likes = 'Quince'; // No es un número

        // Crear una instancia de la clase BookRequest
        $request = new BookRequest();

        // Obtener las reglas de validación
        $rules = $request->rules();

        // Crear un validador con los datos y las reglas
        $validator = Validator::make(['likes' => $likes], $rules);

        // Comprobar que la validación falla
        $this->assertTrue($validator->fails());

        // Comprobar que hay errores de validación 
        $this->assertArrayHasKey('likes', $validator->errors()->toArray());
    }
}
