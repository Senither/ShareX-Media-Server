<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Previewable\HeaderPreview;
use App\Previewable\NullPreview;
use App\Traits\BelongsToUser;
use App\Traits\FileExtensionIcon;
use App\Traits\MediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    use HasFactory;
    use MediaResource;
    use BelongsToUser;
    use FileExtensionIcon;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'original_name',
        'extension',
        'size',
        'hash_md5',
        'hash_sha1',
    ];

    /**
     * List of previewable file types, and the class that
     * handles rendering the given file type.
     *
     * @var array
     */
    protected $previewableTypes = [
        HeaderPreview::class => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a', 'webm',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma', 'pdf',
        ],
    ];

    /**
     * The name of the route used to view the resource directly.
     *
     * @var string
     */
    protected $resourceViewRoute = 'view-file';

    /**
     * The API resource name, this is the API resource name
     * used when registering the route in the API.
     *
     * @var string
     */
    protected $resourceApiName = 'files';

    /**
     * Creates a new text entry, and stores the uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return \App\Models\File
     */
    public static function createAndSave(UploadedFile $file)
    {
        $name = $file->getClientOriginalName();
        $parts = explode('.', $name);

        if (count($parts) > 1) {
            array_shift($parts);
        }

        $model = new self([
            'user_id' => auth()->user()->id,
            'name' => app(IdentifierContract::class)->generate(),
            'original_name' => $name,
            'extension' => strtolower(join('.', $parts)),
            'size' => $file->getSize(),
            'hash_md5' => \md5_file($file->getRealPath()),
            'hash_sha1' => \sha1_file($file->getRealPath()),
        ]);

        $file->storeAs('files', $model->getResourceName());

        $model->save();

        return $model;
    }

    /**
     * Checks if the file is previewable.
     *
     * @return bool
     */
    public function getPreviewableAttribute()
    {
        return collect(\array_values($this->previewableTypes))
            ->flatten()
            ->contains($this->extension);
    }

    /**
     * Create a new previewer instance that can be used to render
     * the file preview, if the previewer is not found the
     * default header previewer will be returned instead.
     *
     * @return \App\Previewable\FilePreview
     */
    public function createPreviewer()
    {
        foreach ($this->previewableTypes as $previewer => $types) {
            if (\in_array($this->extension, $types)) {
                return new $previewer($this);
            }
        }

        return new NullPreview($this);
    }

    /**
     * The belongs to relationship between the file and the user who owns it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the formatted version of the size in with the matching
     * size unit appended to the end of the size.
     *
     * @return string
     */
    public function getFormattedSizeAttribute()
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($this->size, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, 1) . ' ' . $units[$pow];
    }
}
