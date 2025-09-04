<?php

declare(strict_types=1);

namespace App;

use ErrorException;

class Words
{
    /**
     * @throws ErrorException
     */
    public function list(Language $language): array
    {
        $strings = file(filename: __DIR__ . '/../words/' . $language->value . '.txt', flags: FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if (empty($strings)) {
            throw new ErrorException('Empty words file.');
        }

        return $strings;
    }
}
