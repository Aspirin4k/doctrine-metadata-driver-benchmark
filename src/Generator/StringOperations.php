<?php

namespace App\Generator;

class StringOperations
{
    public static function withTabs(string $string, int $tabs = 1): string
    {
        return str_repeat(' ', 4 * $tabs) . $string;
    }
}
