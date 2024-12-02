<?php

namespace App\Http\Requests;

use App\Enums\GenderType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class ProfileRequest extends FormRequest
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
            'recive_email_notification' => ['sometimes', 'required', 'boolean'],
            'recive_sms_notification' => ['sometimes', 'required', 'boolean'],
            'recive_broadcast_notification' => ['sometimes', 'required', 'boolean'],
            'gender' => ['sometimes', 'required', new Enum(GenderType::class)],
            'locale' => ['sometimes', 'required', 'in:en,ar'],
            'avatar' => ['sometimes', 'required', 'image', 'mimes:png,jpg'],
        ];
    }
}
