<?php

namespace App\Identifier;

use Illuminate\Support\Str;

class StringIdentifier implements IdentifierContract
{
    public function generate(): string
    {
        return Str::random(rand(0, 5) + 4);
    }
}
