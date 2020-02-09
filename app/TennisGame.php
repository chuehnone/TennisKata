<?php

namespace App;

use Exception;

class TennisGame
{
    private $player1 = null;

    private $player2 = null;

    private const SCORE_DESCRIPTION = [
        0 => 'Love',
        1 => '15',
        2 => '30',
        3 => '40',
    ];

    public function __construct(Player $player1, Player $player2)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
    }

    /**
     * @throws Exception
     *
     * @return string
     */
    public function getGameDescription(): string
    {
        if ($this->player1 === null || $this->player2 === null) {
            throw new Exception('Oops, the players not ready.');
        }

        $score1 = $this->player1->getScore();
        $score2 = $this->player2->getScore();

        if ($score1 - $score2 === 0) {
            if ($score1 >= 3) {
                return 'Deuce';
            }
            return TennisGame::SCORE_DESCRIPTION[$score1] . '-All';
        }

        if ($score1 > 3 || $score2 > 3) {
            $name = $this->player1->getName();
            if ($score2 > $score1) {
                $name = $this->player2->getName();
            }

            if (abs($score1 - $score2) >= 2) {
                return 'Win for ' . $name;
            }

            return 'Advantage ' . $name;
        }

        return TennisGame::SCORE_DESCRIPTION[$score1] . '-' . TennisGame::SCORE_DESCRIPTION[$score2];
    }
}
