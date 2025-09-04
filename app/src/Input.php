<?php

declare(strict_types=1);

namespace App;

use Exception;

final readonly class Input
{
    /**
     * @throws Exception
     */
    public function __construct(Language $dictionary, public string $character)
    {
        if ($character === '') {
            throw new \DomainException(message: 'Пожалуйста укажите букву.');
        }

        if (!in_array(needle: $character, haystack: $dictionary::get($dictionary), strict: true)) {
            throw new \DomainException(
                message: 'Пожалуйста укажите одну букву от ' .
                mb_strtoupper(string: $dictionary::get($dictionary)[0]) . ' до ' .
                mb_strtoupper(string: $dictionary::get($dictionary)[\count($dictionary::get($dictionary)) - 1])
            );
        }
    }
}
