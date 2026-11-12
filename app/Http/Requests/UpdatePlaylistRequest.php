<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlaylistRequest extends FormRequest
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
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'track_ids' => ['sometimes', 'array'],
            'track_ids.*' => ['integer', 'exists:tracks,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.max' => 'Название плейлиста не должно превышать 255 символов.',
            'description.max' => 'Описание не должно превышать 2000 символов.',
            'track_ids.array' => 'Список треков должен быть массивом.',
            'track_ids.*.exists' => 'Один из указанных треков не существует.',
        ];
    }
}
