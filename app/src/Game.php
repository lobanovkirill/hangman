<?php

declare(strict_types=1);

namespace App;

use ErrorException;
use Exception;

final readonly class Game
{
    public function __construct(
        private Word     $word,
        private GamePlay $score,
        private Hangman  $hangman,
        private Display  $display,
        private Language $dictionary,
    )
    {
    }

    /**
     * @throws ErrorException|Exception
     */
    public function run(): void
    {
        Output::write("🎮 Игра началась!");
        Output::write("Слово: " . $this->display->masked(word: $this->word));
        Output::write("Подсказка: " . $this->display->description(word: $this->word));

        while (true) {
            try {
                if ($this->score->isLoose()) {
                    Output::write('😭 Вы проиграли... Слово, которое я загадал: ' . $this->word->get());
                    break;
                }

                if ($this->score->isWin($this->word)) {
                    Output::write('🎉 Поздравляю! Вы выиграли!');
                    break;
                }

                Output::write('Укажите букву:');
                $input = strtolower(trim(fgets(STDIN)));

                if ($input === Commands::stop->value) {
                    Output::write('🛑 Игра остановлена.');
                    break;
                }

                $input = new Input(dictionary: $this->dictionary, character: $input);

                if ($this->score->isUsed(character: $input->character)) {
                    Output::write('⚠️ Вы уже ранее вводили данную букву!');
                    unset($input);
                    continue;
                }

                if (!$this->word->has($input->character)) {
                    $this->score->addWrongCharacter(character: $input->character);
                    Output::write('🚫 Такой буквы в слове не существует!');
                } else {
                    $this->score->addRightCharacter(character: $input->character);
                    Output::write('✅ Правильная буква!');
                }

                Output::write($this->hangman->current($this->score));
                Output::write('Слово: ' . $this->display->withOpenPart(word: $this->word, score: $this->score));
                Output::write('Вы совершили ошибок: ' . $this->score->countErrors());

                unset($input);
            } catch (\DomainException $e) {
                Output::write($e->getMessage());
                unset($input);
            }
        }
    }
}
