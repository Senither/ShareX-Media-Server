<?php

namespace App\Models;

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
        'extension',
        'size',
        'hash_md5',
        'hash_sha1',
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
        //
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
}