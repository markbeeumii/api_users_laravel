<?php

namespace App\Http\Requests\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

abstract class APIRequest extends FormRequest
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
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'message' => 'Invalid data',
            'errors' => $validator->errors(),
        ], 422);

        throw new ValidationException($validator, $response);
    }

    /**
     * @return array
     */
     public function rules(){
        return[];
     }

    /**
     * @return array
     */
    // abstract public function messages();
}
