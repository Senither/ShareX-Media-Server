<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Contracts\Validation\Validator;

class PlainTextValidationException extends Exception
{
    private $validator;

    /**
     * Create a new exception instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response("The given data was invalid.\n\n" . $this->errorMessages(), 422);
    }

    /**
     * Converts the validation error messages into a plain text string.
     *
     * @return string
     */
    protected function errorMessages()
    {
        $errorMessage = '';

        foreach ($this->validator->errors()->messages() as $error => $messages) {
            $errorMessage .= $error . ":\n";

            foreach ($messages as $message) {
                $errorMessage .= "{$message}\n";
            }

            $errorMessage .= "\n";
        }

        return $errorMessage;
    }
}
