<?php

namespace App\Previewable;

use Storage;
use Symfony\Component\Mime\MimeTypes;

class HeaderPreview extends FilePreview
{
    /**
     * Render the file preview.
     *
     * @return mixed
     */
    public function render()
    {
        return response(Storage::get('files/' . $this->file->getResourceName()))
            ->header('Content-Length', (string) $this->file->size)
            ->header('Accept-Ranges', 'bytes')
            ->header(
                'Content-Type',
                MimeTypes::getDefault()->getMimeTypes($this->file->extension)[0]
            );
    }
}
