<?php

namespace App\Http\Requests;

use App\Enums\UserRole;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['sometimes', Rule::enum(UserRole::class)],
            'bio' => ['nullable', 'string', 'max:1000'],
            'avatar_path' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Имя пользователя обязательно.',
            'name.max' => 'Имя не должно превышать 255 символов.',
            'email.required' => 'Email обязателен.',
            'email.email' => 'Введите корректный email.',
            'email.unique' => 'Пользователь с таким email уже зарегистрирован.',
            'password.required' => 'Пароль обязателен.',
            'password.min' => 'Пароль должен содержать не менее 8 символов.',
            'password.confirmed' => 'Пароли не совпадают.',
            'role.enum' => 'Недопустимая роль пользователя.',
            'bio.max' => 'Описание профиля не должно превышать 1000 символов.',
        ];
    }
}
