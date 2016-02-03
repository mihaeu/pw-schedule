<?php declare(strict_types = 1);

class Room
{
    /**
     * @var int
     */
    private $number;

    /**
     * Room constructor.
     * @param int $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    public function number() : int
    {
        return $this->number;
    }

    public function equals(Room $other) : bool
    {
        return $this->number === $other->number();
    }
}

