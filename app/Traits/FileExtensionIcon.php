<?php

namespace App\Traits;

use App\Scopes\UserScope;
use Illuminate\Support\Arr;

trait FileExtensionIcon
{
    /**
     * A map of file icons and the file extensions
     * that should return the icon name.
     *
     * @var array
     */
    private $fileExtensions = [
        'html' => ['htm', 'xhtml', 'html_vm', 'asp'],
        'markdown' => ['md', 'rst'],
        'sass' => ['scss'],
        'yaml' => ['yml'],
        'docker' => ['dockerfile'],
        'laravel' => ['blade.php'],
        'javascript' => ['js'],
        'typescript' => ['ts', 'd.ts'],
        'python' => ['py'],
        'git' => ['git-commit', 'git-rebase', 'ignore'],
        'settings' => [
            'properties',
            'editorconfig',
            'env',
            'env.ci',
            'env.example',
        ],
    ];

    /**
     * Initializes the file extension icon resource trait.
     */
    public function initializeFileExtensionIcon()
    {
        $this->append('file_icon');
    }

    /**
     * Gets a matching file icon to the file extension of the media file.
     *
     * @return string
     */
    public function getFileIconAttribute()
    {
        foreach ($this->fileExtensions as $icon => $extensions) {
            if (in_array($this->extension, $extensions)) {
                return $icon;
            }
        }
        return $this->extension;
    }
}