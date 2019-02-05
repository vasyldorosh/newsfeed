<?php

namespace App\Services\Parser;

interface ParserInterface
{
    public function parse() : array;

    public function getResourceId() : int;
}
