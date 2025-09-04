<?php

declare(strict_types=1);

namespace App;

final class Output
{
    public static function write(string $message): void
    {
        fwrite(stream: STDOUT, data: $message . PHP_EOL);
    }
}