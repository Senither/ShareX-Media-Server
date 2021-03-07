<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UrlUploadRequest;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    /**
     * Setup the image policy used in the controller for authorization.
     */
    public function __construct()
    {
        $this->authorizeResource(Url::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Url::paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UrlUploadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UrlUploadRequest $request)
    {
        $url = Url::createAndSave($request->get('url'));

        if ($request->header('Accept') == 'text/plain') {
            $url = $url->resource_url;
        }

        return response($url, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function show(Url $url)
    {
        return $url;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Url  $url
     * @return \Illuminate\Http\Response
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return response(null, 204);
    }
}
