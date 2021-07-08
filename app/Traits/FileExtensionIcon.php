<?php

namespace App\Traits;

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
        'zip' => ['zip', 'ear', 'war', 'rar', 'jar', '7z'],
        'video' => ['mp4', 'webm', 'mkv', 'flv', 'vob', 'ogv', 'ogg', 'avi', 'mov', 'wmv'],
        'audio' => [
            '3gp', 'aa', 'aac', 'aax', 'act',
            'aif', 'ala', 'amr', 'ape', 'au',
            'awb', 'dss', 'dvf', 'fla', 'gsm',
            'ikl', 'ivs', 'm4a', 'm4b', 'm4p',
            'mmf', 'mp3', 'mpc', 'msv', 'nmf',
            'opu', 'ra', 'raw', 'rf6', 'sln',
            'tta', 'voc', 'vox', 'wav', 'wma',
            'wv', 'web', '8sv', 'cda',
        ],
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
     *
     * @return void
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
