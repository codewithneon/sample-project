<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'meta.description' => 'required',
            'mobile' => 'required|max:15',
            'email' => 'required|max:255',
            'name' => 'required|max:255',
            'meta.name' => 'required',
        ];
    }
}
