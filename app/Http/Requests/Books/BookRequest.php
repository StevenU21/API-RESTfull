<?php

namespace App\Http\Requests\Books;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
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

    public function messages(): array
    {
        return [
            'title.required' => 'El campo de título es obligatorio',
            'title.min' => 'El título debe tener como mínimo 6 caracteres',
            'title.max' => 'El título debe tener un máximo de 60 caracteres',
            'title.unique' => 'El título debe no debe repetirse',
            'author.required' => 'El autor es obligatorio',
            'author.min' => 'El nombre el autor debe tener al menos 3 caracteres',
            'author.max' => 'El nombre del autor debe tener un máximo de 30 caracteres',
            'genre.required' => 'El género es obligatorio',
            'genre.min' => 'El género debe tener al menos 6 caracteres',
            'genre.max' => 'El género debe tener un máximo de 20 caracteres',
            'publication_year.date' => 'El año de publicación debe tener un formato válido',
            'publication_year.required' => 'El año de publicación es obligatorio',
            'description.required' => 'La descripción es obligatoria',
            'description.min' => 'La descripción debe tener al menos 3 caracteres',
            'description.max' => 'La descripción debe tener un máximo de 300 caracteres',
            'rate.numeric' => 'La calificación debe tener un formato válido',
            'likes.numeric' => 'Los likes deben tener un formato válido'
        ];
    }
}
