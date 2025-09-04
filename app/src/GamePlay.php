<?php

declare(strict_types=1);

namespace App;

final class GamePlay
{
    private const int MAX_ATTEMPTS = 6;
    private array $usesCharacters = [];
    private array $rightCharacters = [];
    private array $wrongCharacters = [];

    public function isLoose(): bool
    {
        if (\count($this->wrongCharacters) >= self::MAX_ATTEMPTS) {
            return true;
        }

        return false;
    }

    public function isWin(Word $word): bool
    {
        return $this->isWordOpened($word);
    }

    public function isUsed(string $character): bool
    {
        if (in_array(needle: $character, haystack: $this->usesCharacters, strict: true)) {
            return true;
        }

        $this->addUsedCharacter(character: $character);
        return false;
    }

    public function addRightCharacter(string $character): void
    {
        if (!in_array(needle: $character, haystack: $this->rightCharacters, strict: true)) {
            $this->rightCharacters[] = $character;
        }
    }

    public function addWrongCharacter(string $character): void
    {
        if (!in_array(needle: $character, haystack: $this->wrongCharacters, strict: true)) {
            $this->wrongCharacters[] = $character;
        }
    }

    public function countErrors(): int
    {
        return \count(value: $this->wrongCharacters);
    }

    public function getRightCharacters(): array
    {
        return $this->rightCharacters;
    }

    private function isWordOpened(Word $word): bool
    {
        $openedCharacters = 0;
        foreach ($word->characters as $character) {
            if (in_array($character, $this->getRightCharacters())) {
                $openedCharacters++;
            }
        }

        if ($openedCharacters === \count($word->characters)) {
            return true;
        }

        return false;
    }

    private function addUsedCharacter(string $character): void
    {
        $this->usesCharacters[] = $character;
    }
}
