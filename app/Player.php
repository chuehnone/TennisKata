<?php

namespace App;

class Player
{
    /**
     * @var string
     */
    private $name = '';

    /**
     * @var int
     */
    private $score = 0;

    public function __construct(string $name, int $score = 0)
    {
        $this->name = $name;
        $this->score = $score;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * @param int $score
     */
    public function setScore(int $score): void
    {
        $this->score = $score;
    }

    public function score()
    {
        ++$this->score;
    }
}
