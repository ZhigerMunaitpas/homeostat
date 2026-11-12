<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
            'track_id' => ['required', 'integer', 'exists:tracks,id'],
            'body' => ['required', 'string', 'min:2', 'max:1000'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'track_id.required' => 'Укажите трек для комментария.',
            'track_id.exists' => 'Указанный трек не существует.',
            'body.required' => 'Текст комментария обязателен.',
            'body.min' => 'Комментарий должен содержать не менее 2 символов.',
            'body.max' => 'Комментарий не должен превышать 1000 символов.',
        ];
    }
}
