<?php declare(strict_types = 1);

/**
 * @covers Appointment
 *
 * @uses AppointmentTitle
 * @uses Room
 * @uses UserCollection
 */
class AppointmentTest extends PHPUnit_Framework_TestCase
{
    use UserHelperTrait;

    public function testMustHaveParticipants()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Appointment must have at least one participant');
        $appointment = new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 days'),
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            new UserCollection()
        );
    }

    public function testBeginningMustBeBeforeEnd()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Beginning has to be before end');
        $participants = new UserCollection();
        $participants->add($this->mockUser());
        $appointment = new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('-1 days'),
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            $participants
        );
    }

    public function testHasRoom()
    {
        $participants = new UserCollection();
        $participants->add($this->mockUser());
        $room = new Room(1);
        $appointment = new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 days'),
            new AppointmentTitle('Test Appointment'),
            $room,
            $participants
        );
        $this->assertEquals($room, $appointment->room());
    }
}

