<?php

declare(strict_types=1);

namespace App;

final readonly class Select
{
    public function word(array $strings): Word
    {
        $numString = rand(0, count($strings) - 1);
        $data = explode(separator: '//', string: trim(string: $strings[$numString]));

        return new Word(word: $data[0], description: $data[1]);
    }
}