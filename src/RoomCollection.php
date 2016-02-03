<?php declare(strict_types = 1);

class RoomCollection implements Countable, IteratorAggregate
{
    /**
     * @var SplObjectStorage
     */
    private $rooms;

    public function __construct()
    {
        $this->rooms = new SplObjectStorage();
    }

    public function add(Room $room)
    {
        $this->ensureRoomDoesNotAlreadyExist($room);

        $this->rooms->attach($room);
    }

    public function getIterator()
    {
        return $this->rooms;
    }

    public function count()
    {
        return count($this->rooms);
    }

    public function contains(Room $other) : bool
    {
        foreach ($this->rooms as $room) {
            /** @var Room $room */
            if ($room->equals($other)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param Room $room
     */
    private function ensureRoomDoesNotAlreadyExist(Room $room)
    {
        if ($this->rooms->contains($room)) {
            throw new InvalidArgumentException('Room already exists');
        }
    }
}


