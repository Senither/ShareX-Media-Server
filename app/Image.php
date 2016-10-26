<?php

namespace App;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'slug', 'height', 'width'];

    /**
     * Sets the route key name, allowing the controllers to type-hint
     * eloquent models to fetch them from their slug.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeAuthAll($query)
    {
        if (Auth::user()->hasPermission('user.image.see')) {
            return $query;
        }

        return $query->where('user_id', Auth::user()->id);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function delete()
    {
        Storage::disk('media')->delete([
            $this->slug.'.png',
            'thumb/'.$this->slug.'.png',
        ]);

        parent::delete();
    }
}
