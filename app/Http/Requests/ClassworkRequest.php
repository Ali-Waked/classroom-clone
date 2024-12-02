<?php

namespace App\Http\Requests;

use App\Enums\ClassworkStatus;
use App\Enums\ClassworkType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ClassworkRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'json'],
            'topic_id' => ['nullable', 'integer', 'exists:topics,id'],
            'type' => ['required', 'string', new Enum(ClassworkType::class)],
            'status' => ['nullable', 'string', new Enum(ClassworkStatus::class)],
            'students' => ['nullable', 'array'],
            'students.*' => ['int','exists:users,id'],
            'published_at' => ['nullable', 'date', 'after:now'],
            'options.file' => ['nullable', 'array'],
            'options.file.*' => ['file', ''],
            'options.points' => ['nullable'],
        ];
    }
}
