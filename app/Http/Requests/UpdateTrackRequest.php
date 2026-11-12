<?php

namespace App\Http\Requests;

use App\Enums\TrackStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTrackRequest extends FormRequest
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
            'genre_id' => ['sometimes', 'integer', 'exists:genres,id'],
            'title' => ['sometimes', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:5000'],
            'cover_path' => ['nullable', 'string', 'max:255'],
            'duration' => ['sometimes', 'integer', 'min:1', 'max:36000'],
            'status' => ['sometimes', Rule::enum(TrackStatus::class)],
            'reject_reason' => [
                'nullable',
                'string',
                'max:255',
                Rule::requiredIf(fn () => $this->input('status') === TrackStatus::Rejected->value),
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'genre_id.exists' => 'Выбранный жанр не существует.',
            'title.max' => 'Название трека не должно превышать 150 символов.',
            'description.max' => 'Описание не должно превышать 5000 символов.',
            'duration.integer' => 'Длительность должна быть целым числом секунд.',
            'duration.min' => 'Длительность должна быть не менее 1 секунды.',
            'status.enum' => 'Недопустимый статус трека.',
            'reject_reason.required' => 'При отклонении трека укажите причину.',
            'reject_reason.max' => 'Причина отклонения не должна превышать 255 символов.',
        ];
    }
}
