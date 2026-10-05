<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePermissionRequest extends FormRequest
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
        $permissionId = $this->route('permission');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('permissions')->where(function ($query) {
                    return $query->where('guard_name', $this->input('guard_name', 'web'));
                })->ignore($permissionId),
            ],
            'group' => [
                'nullable',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'guard_name' => [
                'nullable',
                'string',
                'max:255',
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
            'name' => 'permission name',
            'group' => 'permission group',
            'description' => 'permission description',
        ];
    }
}