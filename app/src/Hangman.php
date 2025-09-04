<?php

declare(strict_types=1);

namespace App;

final class Hangman
{
    /**
     * @var array<int, string> $status
     */
    public array $status = ["
     +---+
     |   |
     |  
     |  
     |  
    _|_
    ", "
     +---+
     |   |
     |   O
     |  
     |  
    _|_
    ", "
     +---+
     |   |
     |   O
     |   |
     |  
    _|_
    ", "
     +---+
     |   |
     |   O
     |  /|
     |  
    _|_
    ", "
     +---+
     |   |
     |   O
     |  /|\\
     |  
    _|_
    ", "
     +---+
     |   |
     |   O
     |  /|\\
     |  /
    _|_
    ", "
     +---+
     |   |
     |   O
     |  /|\\
     |  / \\
    _|_
    "];

    public function current(GamePlay $score): string
    {
        return $this->status[$score->countErrors()];
    }
}