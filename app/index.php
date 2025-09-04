#!/usr/bin/php
<?php

declare(strict_types=1);

use App\Commands;
use App\Language;
use App\Display;
use App\Game;
use App\Hangman;
use App\GamePlay;
use App\Select;
use App\Words;

require_once './vendor/autoload.php';

$isStop = false;
while (!$isStop) {
    fwrite(stream: STDOUT, data: "Для начала новой игры введите 'start'. Чтобы закончить игру 'stop', чтобы выйти из главного меню укажите любой другой символ." . PHP_EOL);
    $command = strtolower(string: trim(string: fgets(stream: STDIN)));

    if (Commands::tryFrom($command) === Commands::play) {

        fwrite(
            stream: STDOUT,
            data: "Укажите язык отгадываемого слова: '" .
            Language::ru->value . "' или '" .
            Language::en->value ."'" . PHP_EOL
        );
        while (true) {
            if (!$language = Language::tryFrom(value: strtolower(string: trim(string: fgets(stream: STDIN)))))
            {
                fwrite(
                    stream: STDOUT,
                    data: "Укажите язык отгадываемого слова: '" .
                    Language::ru->value . "' или '" .
                    Language::en->value ."'" . PHP_EOL
                );
            } else {
                break;
            }
        }

        try {
            new Game(
                    word: new Select()->word(strings: new Words()->list(language: $language)),
                    score: new GamePlay(),
                    hangman: new Hangman(),
                    display: new Display(),
                    dictionary: $language
            )->run();

        } catch (\InvalidArgumentException $e) {
            fwrite(stream: STDOUT, data: $e->getMessage() . PHP_EOL);
        } catch (\Exception $e) {
            fwrite(stream: STDOUT, data: $e->getMessage() . PHP_EOL);
            $isStop = true;
        }
    } else {
        $isStop = true;
        fwrite(stream: STDOUT, data: "👋 Пока, пока!" . PHP_EOL);
    }
}
