<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\API\APIRequest;
use App\Models\Category;

class CategoryCreateRequest extends APIRequest{

 /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                Category::unique('categories')
                    ->where('name', $this->name)
            ],
        ];
    }

    /**
     * Ge the validation messages that apply to the request rules.
     * 
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Category name cannot be empty.',
            'name.unique' => 'Category name already exist.',
        ];
    }
} 