<?php

namespace App\Traits;

use App\Scopes\UserScope;

trait MediaResource
{
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
     * @return string
     */
    public function getResourceName()
    {
        return sprintf('%s/%d/%s.%s', $this->getShortClassName(), $this->user_id, $this->name, $this->extension);
    }

    /**
     * Get the short lowercased version of the class name.
     *
     * @return string
     */
    private function getShortClassName()
    {
        return mb_strtolower((new \ReflectionClass($this))->getShortName());
    }
}
