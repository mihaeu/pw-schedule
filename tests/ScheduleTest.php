<?php declare(strict_types = 1);

/**
 * @covers Schedule
 *
 * @uses RoomCollection
 * @uses Room
 * @uses AppointmentTitle
 * @uses Appointment
 * @uses UserCollection
 */
class ScheduleTest extends PHPUnit_Framework_TestCase
{
    use UserHelperTrait;

    public function testRequiresAtLeastOneRoom()
    {
        $this->setExpectedException(InvalidArgumentException::class, 'Schedule has to be for at least one room');
        new Schedule(new RoomCollection());
    }

    public function testAppointmentHasToBeForTheRightRoom()
    {
        $rooms = new RoomCollection();
        $rooms->add(new Room(1));
        $schedule = new Schedule($rooms);
        $participants = new UserCollection();
        $participants->add($this->mockUser());

        $this->setExpectedException(InvalidArgumentException::class, 'This schedule is not for the room of this appointment');
        $schedule->add(new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 days'),
            new AppointmentTitle('Test'),
            new Room(2),
            $participants
        ));
    }

    public function testCanSetAppointment()
    {
        $rooms = new RoomCollection();
        $rooms->add(new Room(1));
        $schedule = new Schedule($rooms);
        $participants = new UserCollection();
        $participants->add($this->mockUser());

        $schedule->add(new Appointment(
            new DateTimeImmutable(),
            new DateTimeImmutable('+1 days'),
            new AppointmentTitle('Test'),
            new Room(1),
            $participants
        ));
        $this->assertNotNull($schedule);
    }

    public function testPrints()
    {
        $rooms = new RoomCollection();
        $rooms->add(new Room(1));
        $schedule = new Schedule($rooms);
        $participants = new UserCollection();
        $participants->add($this->mockUser());

        $schedule->add(new Appointment(
            new DateTimeImmutable('+3 days'),
            new DateTimeImmutable('+6 days'),
            new AppointmentTitle('Test'),
            new Room(1),
            $participants
        ));

        $schedule->add(new Appointment(
            new DateTimeImmutable('+3 days'),
            new DateTimeImmutable('+6 days'),
            new AppointmentTitle('Test 2'),
            new Room(1),
            $participants
        ));

        $this->assertEquals('Test' . PHP_EOL . 'Test 2', $schedule->__toString());
    }
}
