<?php declare(strict_types = 1);

/**
 * @covers Room
 */
class RoomTest extends PHPUnit_Framework_TestCase
{
    public function testRoomsWithSameNumberAreEqual()
    {
        $room1 = new Room(1);
        $room2 = new Room(1);
        $this->assertTrue($room1->equals($room2));
    }

    public function testRoomsWithDifferentNumberAreNotEqual()
    {
        $room1 = new Room(1);
        $room2 = new Room(2);
        $this->assertFalse($room1->equals($room2));
    }
}

