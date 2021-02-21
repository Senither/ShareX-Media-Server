<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Traits\BelongsToUser;
use App\Traits\MediaResource;
use HyungJu\ReadableURL;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

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
     * The resource identifier, this is what makes each resource unique
     * in the URL when generating links to the media resource.
     *
     * @var string
     */
    protected $resourceIdentifier = 'i';

    /**
     * The API resource name, this is the API resource name
     * used when registering the route in the API.
     *
     * @var string
     */
    protected $resourceApiName = 'images';

    /**
     * The belongs to relationship between the image and the user who owns it.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
}
