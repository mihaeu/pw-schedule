<?php declare(strict_types = 1);

/**
 * @covers Dummy
 */
class DummyTest extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $dummy = new Dummy();
        $this->assertFalse(true);
    }
}

