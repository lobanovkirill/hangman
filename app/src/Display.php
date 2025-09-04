<?php

declare(strict_types=1);

namespace App;

final class Display
{
    public function masked(Word $word): string
    {
        $result = '';
        foreach ($word->characters as $character) {
            $result .= '*';
        }
        return $result;
    }

    public function withOpenPart(Word $word, GamePlay $score): string
    {
        $withMaskedPart = '';
        foreach ($word->characters as $character) {
            if (in_array($character, $score->getRightCharacters())) {
                $withMaskedPart .= $character;
            } else {
                $withMaskedPart .= '*';
            }
        }
        return $withMaskedPart;
    }

    public function description(Word $word): string
    {
        return $word->description();
    }
}
