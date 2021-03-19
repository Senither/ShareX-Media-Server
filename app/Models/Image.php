<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Traits\BelongsToUser;
use App\Traits\MediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Image extends Model
{
    use HasFactory;
    use MediaResource;
    use BelongsToUser;

    /**
     * The list of supported image sizes that should be generated.
     *
     * @var array
     */
    public static $supportedSizes = [512, 256, 128];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'extension'];

    /**
     * The name of the route used to view the resource directly.
     *
     * @var string
     */
    protected $resourceViewRoute = 'view-image';

    /**
     * The API resource name, this is the API resource name
     * used when registering the route in the API.
     *
     * @var string
     */
    protected $resourceApiName = 'images';

    /**
     * A list of file extensions that should be included in the
     * resource URL if the file has a matching file extension.
     *
     * @var array
     */
    protected $resourceExtensions = ['gif'];

    /**
     * Creates a new image entry, and stores the uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return \App\Models\Image
     */
    public static function createAndSave(UploadedFile $file)
    {
        $model = new self([
            'user_id' => auth()->user()->id,
            'name' => app(IdentifierContract::class)->generate(),
            'extension' => $file->extension(),
        ]);

        $file->storeAs('images', $model->getResourceName());

        $model->save();

        return $model;
    }

    /**
     * The belongs to relationship between the image and the user who owns it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
