<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    /**
     * Checks to see if the settings has any positive live values.
     *
     * @return boolean
     */
    public function hasLiveValues()
    {
        return ! $this->getLiveMap()->isEmpty();
    }

    /**
     * Generates the Carbon expiration object using the live map.
     *
     * @return Carbon\Carbon
     */
    public function getLiveTimestamp()
    {
        $carbon = new \Carbon\Carbon;

        foreach ($this->getLiveMap() as $key => $value) {
            $method = 'sub'.ucfirst($key).'s';
            $carbon->{$method}($value);
        }

        return $carbon;
    }

    /**
     * Generates a collection of all the items starting
     * with 'live_' and that has a positive value.
     *
     * @return Illuminate\Support\Collection
     */
    public function getLiveMap()
    {
        $map = [];

        foreach ($this->original as $key => $value) {
            if (! starts_with($key, 'live_') || $value <= 0) {
                continue;
            }

            $map[mb_substr($key, 5, mb_strlen($key))] = $value;
        }

        return collect($map);
    }
}
