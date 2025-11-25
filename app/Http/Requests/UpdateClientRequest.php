<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [
            'name'=> 'required|string|max:191',
            'company'=> 'nullable|string|max:191',
            'email'=> 'nullable|email|max:199|unique:clients,email',
            'phone'=> 'nullable|string|max:40',
            'source'=> 'nullable|string|max:191',
            'notes'=> 'nullable|string',
            'meta'=> 'nullable|array',
            'owner_id'=> 'nullable|exists:users,id',

        ];
    }
}
