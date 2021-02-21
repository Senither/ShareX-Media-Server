<?php

namespace App\Http\Requests;

use App\Exceptions\PlainTextValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

abstract class ApiRequest extends FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->header('Accept') == 'text/plain') {
            throw new PlainTextValidationException($validator);
        }

        parent::failedValidation($validator);
    }
}
