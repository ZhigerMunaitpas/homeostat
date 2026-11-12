<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGenreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $genreId = $this->route('genre')?->id ?? $this->route('genre');

        return [
            'name' => ['sometimes', 'string', 'max:255', Rule::unique('genres', 'name')->ignore($genreId)],
            'slug' => ['sometimes', 'string', 'max:255', 'alpha_dash', Rule::unique('genres', 'slug')->ignore($genreId)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.unique' => 'Жанр с таким названием уже существует.',
            'slug.alpha_dash' => 'Slug может содержать только буквы, цифры, дефис и подчёркивание.',
            'slug.unique' => 'Жанр с таким slug уже существует.',
        ];
    }
}
