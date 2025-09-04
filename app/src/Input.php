<?php

declare(strict_types=1);

namespace App;

use Exception;

final readonly class Input
{
    /**
     * @throws Exception
     */
    public function __construct(Language $language, public string $character)
    {
        if ($character === '') {
            throw new \DomainException(message: 'Пожалуйста укажите букву.');
        }

        if (!in_array(needle: $character, haystack: $language::allowedCharactersFor($language), strict: true)) {
            throw new \DomainException(
                message: 'Пожалуйста укажите одну букву от ' .
                mb_strtoupper(string: $language::firstLetterAlphabet($language)) . ' до ' .
                mb_strtoupper(string: $language::lastLetterAlphabet($language))
            );
        }
    }
}
