<?php declare(strict_types = 1);

/**
 * @covers AppointmentTitle
 */
class AppointmentTitleTest extends PHPUnit_Framework_TestCase
{
    public function testHasTitle()
    {
        $appointmentTitle = new AppointmentTitle('bla');
        $this->assertEquals('bla', $appointmentTitle->__toString());
    }

    public function testTitleCannotBeEmpty()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Title cannot be empty');
        new AppointmentTitle('');
    }
}

