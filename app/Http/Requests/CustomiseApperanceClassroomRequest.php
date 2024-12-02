<?php

namespace App\Http\Requests;

use App\Enums\ThemeTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CustomiseApperanceClassroomRequest extends FormRequest
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
            'theme' => ['nullable', 'string', new Enum(ThemeTypes::class)],
            'upload-photo' => ['nullable', 'image'],
        ];
    }
    public function messages()
    {
        return [
            'theme.*' => 'error this not allow',
        ];
    }
}
