<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $settings;

    public function __construct()
    {
        View::share('settings', $this->settings());
    }

    public function settings()
    {
        return $this->settings ?: $this->settings = Settings::first();
    }
}
