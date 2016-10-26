<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check() ? Auth::user()->hasPermission('settings.update') : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'per_page' => 'required|numeric',
            'live_day' => 'required|numeric',
            'live_hour' => 'required|numeric',
            'live_minute' => 'required|numeric',
        ];
    }
}
