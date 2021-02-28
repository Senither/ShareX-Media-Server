<?php

namespace App\Http\Controllers;

use App\Models\Text;
use App\Scopes\UserScope;
use Illuminate\Http\Request;

class RenderTextController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  string $id
     * @param  string|null $type
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id, $raw = null)
    {
        $text = $this->loadTextOrFail($id);

        if (!$raw) {
            return view('preview.text', compact('text'));
        }

        return response($text->content)->header('Content-Type', 'text/plain');
    }

    /**
     * Loads the text with the given name, or fails trying.
     *
     * @param  string $name
     * @return \App\Models\Text
     */
    protected function loadTextOrFail($name)
    {
        $parts = explode('.', $name);

        $text = Text::withoutGlobalScope(UserScope::class)
            ->where('name', array_shift($parts))
            ->firstOrFail();

        if (count($parts) > 0) {
            abort_unless($parts[0] == $text->extension, 404);
        }

        return $text;
    }
}
