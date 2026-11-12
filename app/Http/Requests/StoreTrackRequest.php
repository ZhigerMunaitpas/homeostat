<?php

namespace App\Http\Requests;

use App\Enums\TrackStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTrackRequest extends FormRequest
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
            'genre_id' => ['required', 'integer', 'exists:genres,id'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:5000'],
            'audio_path' => ['required', 'string', 'max:255'],
            'cover_path' => ['nullable', 'string', 'max:255'],
            'duration' => ['required', 'integer', 'min:1', 'max:36000'],
            'status' => ['sometimes', Rule::enum(TrackStatus::class)],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'genre_id.required' => 'Укажите жанр трека.',
            'genre_id.exists' => 'Выбранный жанр не существует.',
            'title.required' => 'Название трека обязательно.',
            'title.max' => 'Название трека не должно превышать 150 символов.',
            'description.max' => 'Описание не должно превышать 5000 символов.',
            'audio_path.required' => 'Необходимо указать аудиофайл.',
            'duration.required' => 'Укажите длительность трека.',
            'duration.integer' => 'Длительность должна быть целым числом секунд.',
            'duration.min' => 'Длительность должна быть не менее 1 секунды.',
            'status.enum' => 'Недопустимый статус трека.',
        ];
    }
}
