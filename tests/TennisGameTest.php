<?php

namespace Tests;

use App\Player;
use App\TennisGame;

class TennisGameTest extends TestCase
{
    public function testGetGameDescriptionDifferentScore()
    {
        $player1 = new Player('A', 1);
        $player2 = new Player('B');
        $game = new TennisGame($player1, $player2);
        $this->assertEquals('15-Love', $game->getGameDescription());

        $player2->setScore(2);
        $this->assertEquals('15-30', $game->getGameDescription());

        $player2->setScore(3);
        $this->assertEquals('15-40', $game->getGameDescription());

        $player1->setScore(2);
        $player2->setScore(0);
        $this->assertEquals('30-Love', $game->getGameDescription());

        $player2->setScore(1);
        $this->assertEquals('30-15', $game->getGameDescription());

        $player2->setScore(3);
        $this->assertEquals('30-40', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(0);
        $this->assertEquals('40-Love', $game->getGameDescription());

        $player2->setScore(1);
        $this->assertEquals('40-15', $game->getGameDescription());

        $player2->setScore(2);
        $this->assertEquals('40-30', $game->getGameDescription());
    }

    public function testGetGameDescriptionSameScore()
    {
        $player1 = new Player('A');
        $player2 = new Player('B');
        $game = new TennisGame($player1, $player2);
        $this->assertEquals('Love-All', $game->getGameDescription());

        $player1->setScore(1);
        $player2->setScore(1);
        $this->assertEquals('15-All', $game->getGameDescription());

        $player1->setScore(2);
        $player2->setScore(2);
        $this->assertEquals('30-All', $game->getGameDescription());
    }

    public function testGetGameDescriptionDeuce()
    {
        $player1 = new Player('A', 3);
        $player2 = new Player('B', 3);
        $game = new TennisGame($player1, $player2);
        $this->assertEquals('Deuce', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(4);
        $this->assertEquals('Deuce', $game->getGameDescription());

        $player1->setScore(5);
        $player2->setScore(5);
        $this->assertEquals('Deuce', $game->getGameDescription());
    }

    public function testGetGameDescriptionAdvantage()
    {
        $player1 = new Player('A', 4);
        $player2 = new Player('B', 3);
        $game = new TennisGame($player1, $player2);
        $this->assertEquals('Advantage A', $game->getGameDescription());

        $player1->setScore(5);
        $player2->setScore(4);
        $this->assertEquals('Advantage A', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(4);
        $this->assertEquals('Advantage B', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(5);
        $this->assertEquals('Advantage B', $game->getGameDescription());
    }

    public function testGetGameDescriptionWinner()
    {
        $player1 = new Player('A', 4);
        $player2 = new Player('B', 0);
        $game = new TennisGame($player1, $player2);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(1);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(2);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(5);
        $player2->setScore(3);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(0);
        $player2->setScore(4);
        $this->assertEquals('Win for B', $game->getGameDescription());

        $player1->setScore(1);
        $player2->setScore(4);
        $this->assertEquals('Win for B', $game->getGameDescription());

        $player1->setScore(2);
        $player2->setScore(4);
        $this->assertEquals('Win for B', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(5);
        $this->assertEquals('Win for B', $game->getGameDescription());
    }

    public function testGetGameDescriptionDifferentScoreWithTiebreak()
    {
        $player1 = new Player('A', 1);
        $player2 = new Player('B');
        $game = new TennisGame($player1, $player2, TennisGame::MODE_TIEBREAK);
        $this->assertEquals('1-0', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(3);
        $this->assertEquals('4-3', $game->getGameDescription());

        $player1->setScore(6);
        $player2->setScore(3);
        $this->assertEquals('6-3', $game->getGameDescription());
    }

    public function testGetGameDescriptionSameScoreWithTiebreak()
    {
        $player1 = new Player('A');
        $player2 = new Player('B');
        $game = new TennisGame($player1, $player2, TennisGame::MODE_TIEBREAK);
        $this->assertEquals('0-All', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(3);
        $this->assertEquals('3-All', $game->getGameDescription());

        $player1->setScore(6);
        $player2->setScore(6);
        $this->assertEquals('6-All', $game->getGameDescription());
    }

    public function testGetGameDescriptionWinnerWithTiebreak()
    {
        $player1 = new Player('A', 7);
        $player2 = new Player('B', 5);
        $game = new TennisGame($player1, $player2, TennisGame::MODE_TIEBREAK);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(10);
        $player2->setScore(8);
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(5);
        $player2->setScore(7);
        $this->assertEquals('Win for B', $game->getGameDescription());

        $player1->setScore(8);
        $player2->setScore(10);
        $this->assertEquals('Win for B', $game->getGameDescription());
    }
}
