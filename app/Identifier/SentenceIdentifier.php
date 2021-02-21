<?php

namespace App\Identifier;

use HyungJu\ReadableURL;

class SentenceIdentifier implements IdentifierContract
{
    public function generate(): string
    {
        return (new ReadableURL(false, rand(3, 5), '-'))->generate();
    }
}
