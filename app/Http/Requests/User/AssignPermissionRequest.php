<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssignPermissionRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'permissions' => [
                'required',
                'array',
                'min:1',
            ],
            'permissions.*' => [
                'integer',
                'exists:permissions,id',
            ],
        ];
    }

    /**
     * Get custom attributes for validation messages.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'permissions' => 'permissions',
            'permissions.*' => 'permission',
        ];
    }
}