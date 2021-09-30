<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'name' => ['required', 'string', 'max:400'],
            'description' => ['required', 'string'],
            'sku' => ['required', 'string', 'max:400'],
            'stock' => ['required', 'integer'],
            'status' => ['required', 'string', 'max:400'],
            'variable' => ['required', 'string'],
        ];
    }
}
