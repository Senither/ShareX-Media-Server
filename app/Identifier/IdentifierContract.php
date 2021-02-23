<?php

namespace App\Identifier;

interface IdentifierContract
{
    /**
     * Genertes a random identifier.
     *
     * @return string
     */
    public function generate(): string;
}
