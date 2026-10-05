<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRoleRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('guard_name', $this->input('guard_name', 'web'));
                }),
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'is_super_admin' => [
                'nullable',
                'boolean',
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
            'name' => 'role name',
            'description' => 'role description',
        ];
    }
}