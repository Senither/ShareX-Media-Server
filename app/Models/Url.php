<?php

namespace App\Models;

use App\Identifier\IdentifierContract;
use App\Traits\BelongsToUser;
use App\Traits\MediaResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    use MediaResource;
    use BelongsToUser;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'name', 'url'];

    /**
     * The name of the route used to view the resource directly.
     *
     * @var string
     */
    protected $resourceViewRoute = 'view-url';

    /**
     * The API resource name, this is the API resource name
     * used when registering the route in the API.
     *
     * @var string
     */
    protected $resourceApiName = 'urls';

    /**
     * Creates a new url entry, and stores url
     *
     * @param  string $url
     * @return \App\Models\Url
     */
    public static function createAndSave(string $url)
    {
        return self::create([
            'user_id' => auth()->user()->id,
            'name' => app(IdentifierContract::class)->generate(),
            'url' => $url,
        ]);
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
     * Creates a URL to the direct resource using the
     * shortest URL defined of all the domains.
     *
     * @return string
     */
    public function getResourceUrlAttribute()
    {
        $url = route($this->resourceViewRoute, $this);

        $domain = collect(app('settings')->get('app.domains'))
            ->add(url('/'))
            ->sort(fn ($first, $second) => strlen($first) > strlen($second))
            ->flatten()
            ->get(0);

        if ($domain == null) {
            return $url;
        }

        return str_replace(url('/'), $domain, $url);
    }
}
