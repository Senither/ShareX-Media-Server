<?php

namespace App\Previewable;

use Storage;

class NullPreview extends FilePreview
{
    /**
     * Render the file preview.
     *
     * @return mixed
     */
    public function render()
    {
        return Storage::download(
            'files/' . $this->file->getResourceName(),
            $this->file->original_name
        );
    }
}
