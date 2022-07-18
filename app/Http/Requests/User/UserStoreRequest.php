<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'meta.description' => 'required',
            'mobile' => 'required|unique:users|max:15',
            'email' => 'required|unique:users|max:255',
            'name' => 'required|max:255',
            'meta.name' => 'required',
        ];
    }

    /**
     * @return string[]
     */
    public function filters(): array
    {
        return [
            'email' => 'trim|lowercase',
            'name' => 'trim|escape'
        ];
    }
}
