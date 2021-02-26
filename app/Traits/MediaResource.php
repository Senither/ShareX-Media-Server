<?php

namespace App\Traits;

use App\Scopes\UserScope;

trait MediaResource
{
    /**
     * Initializes the media resource trait.
     */
    public function initializeMediaResource()
    {
        $this->append('resource_url');
        $this->append('resource_api');
    }

    /**
     * The route key name, allowing the controllers to type-hint
     * eloquent models to fetch them from their name.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'name';
    }

    /**
     * Generates the resource name for the current model instance.
     *
     * @param  string $type
     * @return string
     */
    public function getResourceName($type = null)
    {
        if ($type == null) {
            return sprintf('%d/%s.%s', $this->user_id, $this->name, $this->extension);
        }
        return sprintf('%d/%s-%s.%s', $this->user_id, $this->name, $type, $this->extension);
    }

    /**
     * Creates a URL to the direct resource for the current media resource.
     *
     * @return string
     */
    public function getResourceUrlAttribute()
    {
        $url = url($this->resourceIdentifier . '/' . $this->name);

        if (in_array($this->extension, $this->resourceExtensions ?? [])) {
            $url .= '.' . $this->extension;
        }

        return $url;
    }

    /**
     * Creates a URL to the resource API route for the current media resource.
     *
     * @return string
     */
    public function getResourceApiAttribute()
    {
        return url('api/' . $this->resourceApiName . '/' . $this->name);
    }
}
