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

    public function testPrints()
    {
        $participants = new UserCollection();
        $participants->add($this->mockUser());
        $appointment = new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('+2 days'),
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            $participants
        );
        $this->assertEquals('Test Appointment', $appointment->__toString());
    }

    public function testHasStart()
    {
        $participants = new UserCollection();
        $participants->add($this->mockUser());
        $beginsAt = new DateTimeImmutable();
        $endsAt = new DateTimeImmutable('+2 days');
        $appointment = new Appointment(
            $beginsAt,
            $endsAt,
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            $participants
        );
        $this->assertEquals($beginsAt, $appointment->beginsAt());
    }

    public function testHasEnd()
    {
        $participants = new UserCollection();
        $participants->add($this->mockUser());
        $beginsAt = new DateTimeImmutable();
        $endsAt = new DateTimeImmutable('+2 days');
        $appointment = new Appointment(
            $beginsAt,
            $endsAt,
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            $participants
        );
        $this->assertEquals($endsAt, $appointment->endsAt());
    }

    public function testCanAddParticipantsLater()
    {
        $participants = new UserCollection();
        $participant1 = $this->mockUser('one');
        $participants->add($participant1);
        $beginsAt = new DateTimeImmutable();
        $endsAt = new DateTimeImmutable('+2 days');
        $appointment = new Appointment(
            $beginsAt,
            $endsAt,
            new AppointmentTitle('Test Appointment'),
            new Room(1),
            $participants
        );
        $participant2 = $this->mockUser('two');
        $appointment->addParticipant($participant2);
        $this->assertEquals($participant1, iterator_to_array($appointment->participants())[0]);
        $this->assertEquals($participant2, iterator_to_array($appointment->participants())[1]);
    }
}

