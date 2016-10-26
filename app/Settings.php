<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    public function hasLiveValues()
    {
        foreach ($this->original as $key => $value) {
            if (! starts_with($key, 'live_')) {
                continue;
            }

            if ($value > 0) {
                return true;
            }
        }

        return false;
    }

    public function getLiveTimestamp()
    {
        $carbon = new \Carbon\Carbon;

        foreach ($this->original as $key => $value) {
            if (! starts_with($key, 'live_')) {
                continue;
            }

            if ($value <= 0) {
                continue;
            }

            $method = 'sub'.ucfirst(mb_substr($key, 5, mb_strlen($key))).'s';
            $carbon->{$method}($value);
        }

        return $carbon;
    }
}
