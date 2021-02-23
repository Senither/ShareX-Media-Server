<?php

namespace App\Identifier;

use HyungJu\ReadableURL;

class WordlistIdentifier implements IdentifierContract
{
    public function generate(): string
    {
        return (new ReadableURL(true, rand(3, 5)))->generate();
    }
}
