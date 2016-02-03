<?php declare(strict_types = 1);

/**
 * @covers UserCollection
 */
class UserCollectionTest extends PHPUnit_Framework_TestCase
{
    use UserHelperTrait;

    public function testEmptyCollectionHasCount0()
    {
        $collection = new UserCollection();
        $this->assertCount(0, $collection);
    }

    public function testIsCountable()
    {
        $collection = new UserCollection();
        $collection->add($this->mockUser());
        $collection->add($this->mockUser());
        $this->assertCount(2, $collection);
    }

    public function testIsTraversible()
    {
        $collection = new UserCollection();
        $user1 = $this->mockUser();
        $user2 = $this->mockUser();
        $collection->add($user1);
        $collection->add($user2);
        $this->assertEquals($user2, iterator_to_array($collection)[1]);
    }
}

