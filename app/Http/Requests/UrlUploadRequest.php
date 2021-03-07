<?php

namespace App\Http\Requests;

class UrlUploadRequest extends ApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'url' => ['required', 'string', 'url'],
        ];
    }
}
