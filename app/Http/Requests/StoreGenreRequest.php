<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreGenreRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', 'unique:genres,name'],
            'slug' => ['required', 'string', 'max:255', 'alpha_dash', 'unique:genres,slug'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Название жанра обязательно.',
            'name.unique' => 'Жанр с таким названием уже существует.',
            'slug.required' => 'Slug жанра обязателен.',
            'slug.alpha_dash' => 'Slug может содержать только буквы, цифры, дефис и подчёркивание.',
            'slug.unique' => 'Жанр с таким slug уже существует.',
        ];
    }
}
