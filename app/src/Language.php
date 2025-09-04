<?php

declare(strict_types=1);

namespace App;

use Exception;

enum Language: string
{
    case ru = 'ru';
    case en = 'en';

    /**
     * @throws Exception
     */
    public static function allowedCharactersFor(self $language): array
    {
        return match ($language) {
            self::ru => mb_str_split(string: 'абвгдеёжзийклмнопрстуфхцчшщъыьэюя', encoding: 'UTF-8'),
            self::en => mb_str_split(string: 'abcdefghijklmnopqrstuvwxyz', encoding: 'UTF-8'),
            default => throw new Exception('Unsupported language: ' . $language->value),
        };
    }

    /**
     * @throws Exception
     */
    public static function firstLetterAlphabet(self $language): string
    {
        $dictionary = self::allowedCharactersFor($language);
        return $dictionary[0];
    }

    /**
     * @throws Exception
     */
    public static function lastLetterAlphabet(self $language): string
    {
        $dictionary = self::allowedCharactersFor($language);
        return $dictionary[\count($dictionary) - 1];
    }
}
