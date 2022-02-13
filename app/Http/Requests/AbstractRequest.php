<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Response\Response as ApiResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractRequest extends FormRequest
{
    protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json(
            (new ApiResponse(
                true, 
                Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY], 
                (array)$validator->errors()->messages()
            )), 
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }

}
