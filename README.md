# 📚 Books API

Esta es una API RESTful construida con **Laravel 11**, diseñada para gestionar una colección de libros. Implementa buenas prácticas de desarrollo como el principio de responsabilidad única (SRP) y está basada en pruebas, incluyendo tanto pruebas de características (feature tests) como pruebas unitarias (unit tests).

## 📑 Tabla de Contenidos

- [🎯 Requisitos](#-requisitos)
- [⚙️ Instalación](#-instalación)
- [🛠️ Configuración](#-configuración)
- [📋 Migraciones](#-migraciones)
- [🛤️ Rutas de la API](#-rutas-de-la-api)
- [🛡️ Validación](#-validación)
- [🧪 Pruebas](#-pruebas)
- [📜 Licencia](#-licencia)

## 🎯 Requisitos

- 🐘 PHP 8.2.14 o superior
- 📦 Composer
- 🌐 Laravel 11
- 🗄️ MySQL o SQLite

## ⚙️ Instalación

1. Clona el repositorio:
   ```sh
   git clone https://github.com/StevenU21/API-RESTfull
   cd API-RESTfull
   ```

2. Instala las dependencias de Composer:
   ```sh
   composer install
   ```

3. Copia el archivo de entorno y configura tus variables de entorno:
   ```sh
   cp .env.example .env
   ```

4. Genera la clave de la aplicación:
   ```sh
   php artisan key:generate
   ```

## 🛠️ Configuración

Configura tu base de datos en el archivo `.env`:
```env
DB_CONNECTION=mysql / sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

## 📋 Migraciones

Ejecuta las migraciones para crear las tablas necesarias:
```sh
php artisan migrate
```

```sh
php artisan migrate:fresh --seed
```

## 🛤️ Rutas de la API

Las siguientes rutas están disponibles en esta API:

- 🔍 Buscar libros:
  ```http
  GET /api/books/search
  ```

- 📚 CRUD de libros:
  ```http
  GET /api/books
  POST /api/books
  GET /api/books/{id}
  PUT /api/books/{id}
  DELETE /api/books/{id}
  ```

### Ejemplo de Esquema de Base de Datos

```php
public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->increments('id');
        $table->string('title', 60)->unique();
        $table->string('author', 30);
        $table->string('genre', 20);
        $table->date('publication_year');
        $table->text('description', 300);
        $table->float('rate')->default(0);
        $table->integer('likes')->default(0);
        $table->timestamps();
    });
}
```

## 🛡️ Validación

Las reglas de validación para los libros son las siguientes:

```php
public function rules(): array
{
    return [
        'title' => ['required', 'min:6', 'max:60', 'unique:books,title,except,id'],
        'author' => ['required', 'min:3', 'max:30'],
        'genre' => ['required', 'min:6', 'max:20'],
        'publication_year' => ['required', 'date'],
        'description' => ['required', 'min:3', 'max:300'],
        'rate' => ['numeric'],
        'likes' => ['numeric']
    ];
}
```

## 🧪 Pruebas

Este proyecto incluye tanto pruebas de características como pruebas unitarias para asegurar la calidad y funcionalidad del código.

### Pruebas de Características

- `DeleteBooksTest`
- `GetBooksTest`
- `SearchBooksTest`
- `ShowBooksTest`
- `StoreBooksTest`
- `UpdateBooksTest`

### Pruebas Unitarias

- `BookRequestTest`

Para ejecutar las pruebas, usa el siguiente comando:
```sh
php artisan test
```

## 📜 Licencia

Este proyecto está licenciado bajo la [MIT License](LICENSE).

