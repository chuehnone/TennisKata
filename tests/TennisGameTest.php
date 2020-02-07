<?php

namespace Tests;

use App\Player;
use App\TennisGame;

class TennisGameTest extends TestCase
{
    public function testGetGameDescription()
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

        $player1->setScore(1);
        $player2->setScore(0);
        $this->assertEquals('15-Love', $game->getGameDescription());
        $player1->score();
        $this->assertEquals('30-Love', $game->getGameDescription());
        $player1->score();
        $this->assertEquals('40-Love', $game->getGameDescription());
        $player1->score();
        $this->assertEquals('Win for A', $game->getGameDescription());

        $player1->setScore(0);
        $player2->setScore(1);
        $this->assertEquals('Love-15', $game->getGameDescription());
        $player2->score();
        $this->assertEquals('Love-30', $game->getGameDescription());
        $player2->score();
        $this->assertEquals('Love-40', $game->getGameDescription());
        $player2->score();
        $this->assertEquals('Win for B', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(3);
        $this->assertEquals('Deuce', $game->getGameDescription());
        $player1->setScore(4);
        $player2->setScore(4);
        $this->assertEquals('Deuce', $game->getGameDescription());

        $player1->setScore(4);
        $player2->setScore(3);
        $this->assertEquals('Advantage A', $game->getGameDescription());

        $player1->setScore(3);
        $player2->setScore(4);
        $this->assertEquals('Advantage B', $game->getGameDescription());

        $player1->setScore(1);
        $player2->setScore(2);
        $this->assertEquals('15-30', $game->getGameDescription());
        $player1->setScore(2);
        $player2->setScore(1);
        $this->assertEquals('30-15', $game->getGameDescription());

        $player1->setScore(2);
        $player2->setScore(3);
        $this->assertEquals('30-40', $game->getGameDescription());
        $player1->setScore(3);
        $player2->setScore(2);
        $this->assertEquals('40-30', $game->getGameDescription());
    }
}
