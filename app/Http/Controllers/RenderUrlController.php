<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Scopes\UserScope;
use GuzzleHttp\Psr7\MimeType;
use Illuminate\Support\Facades\Storage;

class RenderUrlController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string $id
     * @param  string|null $preview
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function __invoke($id, $preview = null)
    {
        $url = Url::withoutGlobalScope(UserScope::class)
            ->where('name', $id)
            ->firstOrFail();

        if ($preview) {
            return $this->createPreview($url);
        }

        $url->increment('visits');

        return redirect($url->url);
    }

    /**
     * Create the preview response.
     *
     * @param  \App\Models\Url $url
     * @return \Illuminate\Http\Response|void
     */
    protected function createPreview($url)
    {
        $path = 'urls/' . $url->name . '.jpg';

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response(Storage::get($path))
            ->header('Content-Type', MimeType::fromExtension('jpg'));
    }
}
