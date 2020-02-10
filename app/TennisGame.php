<?php

namespace App;

use Exception;

class TennisGame
{
    public const MODE_GAME = 0;
    public const MODE_TIEBREAK = 1;
    private const SCORE_DESCRIPTION = [
        0 => 'Love',
        1 => '15',
        2 => '30',
        3 => '40',
    ];

    /**
     * @var Player|null
     */
    private $player1 = null;

    /**
     * @var Player|null
     */
    private $player2 = null;

    /**
     * @var int
     */
    private $mode;

    public function __construct(Player $player1, Player $player2, int $mode = TennisGame::MODE_GAME)
    {
        $this->player1 = $player1;
        $this->player2 = $player2;
        $this->mode = $mode;
    }

    /**
     * @throws Exception
     *
     * @return string
     */
    public function getGameDescription(): string
    {
        if (null === $this->player1 || null === $this->player2) {
            throw new Exception('Oops, the players not ready.');
        }

        $mode = $this->mode;
        $score1 = $this->player1->getScore();
        $score2 = $this->player2->getScore();
        $compareScore = $mode === TennisGame::MODE_GAME ? 3 : 6;

        if ($score1 - $score2 === 0) {
            if ($score1 >= 3 && TennisGame::MODE_GAME === $mode) {
                return 'Deuce';
            }
            return $this->getScoreDescription($score1, $mode) . '-All';
        }

        if ($score1 > $compareScore || $score2 > $compareScore) {
            $name = $this->player1->getName();
            if ($score2 > $score1) {
                $name = $this->player2->getName();
            }

            if (abs($score1 - $score2) >= 2) {
                return 'Win for ' . $name;
            }

            if (TennisGame::MODE_GAME === $mode) {
                return 'Advantage ' . $name;
            }
        }

        return $this->getScoreDescription($score1, $mode) . '-' . $this->getScoreDescription($score2, $mode);
    }

    /**
     * @param int $score
     * @param int $mode
     *
     * @return string
     */
    private function getScoreDescription(int $score, int $mode): string
    {
        if (TennisGame::MODE_TIEBREAK === $mode) {
            return $score;
        }

        return TennisGame::SCORE_DESCRIPTION[$score];
    }
}
