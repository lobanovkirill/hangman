<?php

declare(strict_types=1);

namespace App;

final class Word
{
    public array $characters {
        get {
            return $this->characters;
        }
    }

    public function __construct(
        private readonly string $word,
        private readonly string $description
    )
    {
        if ($this->word === '') {
            throw new \InvalidArgumentException('Word must not be empty.');
        }

        if ($this->description === '') {
            throw new \InvalidArgumentException('Description must not be empty.');
        }

        $this->characters = mb_str_split(string: trim($this->word), encoding: 'UTF-8');
    }

    public function has(string $character): bool
    {
        if (in_array($character, $this->characters)) {
            return true;
        }

        return false;
    }

    public function get(): string
    {
        return $this->word;
    }

    public function description(): string
    {
        return $this->description;
    }
}
