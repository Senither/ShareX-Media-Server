<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Traits\BelongsToUser;
use App\Traits\FileExtensionIcon;
use App\Traits\MediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class Text extends Model
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
    protected $resourceApiName = 'texts';

    /**
     * Creates a new text entry, and stores the uploaded file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return \App\Models\Text
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
            'content' => file_get_contents($file->getRealPath()),
        ]);

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

    /**
     * Counts the amount of lines the text document contains.
     *
     * @return string
     */
    public function getLineCountAttribute()
    {
        return number_format(count(explode("\n", rtrim($this->content))));
    }

    /**
     * Counts the amount of words the text document contains.
     *
     * @return string
     */
    public function getWordCountAttribute()
    {
        return number_format(str_word_count(rtrim($this->content)));
    }
}
