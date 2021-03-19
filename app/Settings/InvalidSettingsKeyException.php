<?php

namespace App\Settings;

use RuntimeException;

class InvalidSettingsKeyException extends RuntimeException
{
    /**
     * Create a new instance of the invalid settings key exception.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        parent::__construct('No settings key exist called "' . $key . '"');
    }
}
