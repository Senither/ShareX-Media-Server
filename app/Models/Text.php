<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Traits\BelongsToUser;
use App\Traits\MediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Text extends Model
{
    use HasFactory;
    use MediaResource;
    use BelongsToUser;

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
        'content',
    ];

    /**
     * The name of the route used to view the resource directly.
     *
     * @var string
     */
    protected $resourceViewRoute = 'view-text';

    /**
     * The API resource name, this is the API resource name
     * used when registering the route in the API.
     *
     * @var string
     */
    protected $resourceApiName = 'text';

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
        $name = $file->getClientOriginalName();
        $parts = explode('.', $name);

        $model = new self([
            'user_id' => auth()->user()->id,
            'name' => app(IdentifierContract::class)->generate(),
            'original_name' => $name,
            'extension' => end($parts),
            'content' => file_get_contents($file->getRealPath()),
        ]);

        $model->save();

        return $model;
    }
}
