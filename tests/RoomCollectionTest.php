<?php declare(strict_types = 1);

/**
 * @covers RoomCollection
 *
 * @uses Room
 */
class RoomCollectionTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyCollectionHasCount0()
    {
        $collection = new RoomCollection();
        $this->assertCount(0, $collection);
    }

    public function testIsCountable()
    {
        $collection = new RoomCollection();
        $collection->add(new Room(1));
        $collection->add(new Room(2));
        $this->assertCount(2, $collection);
    }

    public function testIsTraversible()
    {
        $collection = new RoomCollection();
        $room1 = new Room(1);
        $room2 = new Room(2);
        $collection->add($room1);
        $collection->add($room2);
        $this->assertEquals($room1, iterator_to_array($collection)[0]);
        $this->assertEquals($room2, iterator_to_array($collection)[1]);
    }

    public function testRoomCannotExistTwice()
    {
        $collection = new RoomCollection();
        $room1 = new Room(1);
        $collection->add($room1);
        
        $this->setExpectedException(InvalidArgumentException::class, 'Room already exists');
        $collection->add($room1);
    }

    public function testDetectsIfRoomAlreadyExists()
    {
        $collection = new RoomCollection();
        $room1 = new Room(1);
        $collection->add($room1);
        $this->assertTrue($collection->contains($room1));
    }


    public function testDetectsIfRoomDoesNotExist()
    {
        $collection = new RoomCollection();
        $this->assertFalse($collection->contains(new Room(2)));
    }
}

