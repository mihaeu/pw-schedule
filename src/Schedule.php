<?php declare(strict_types = 1);

class Schedule
{
    /**
     * @var SplObjectStorage
     */
    private $appointments;

    /**
     * @var RoomCollection
     */
    private $rooms;

    /**
     * Schedule constructor.
     * @param RoomCollection $rooms
     */
    public function __construct(RoomCollection $rooms)
    {
        $this->ensureThereIsAtLeastOneRoom($rooms);

        $this->rooms = $rooms;
        $this->appointments = new SplObjectStorage();
    }

    public function add(Appointment $appointment)
    {
        $this->ensureAppointmentRoomIsBookable($appointment);
        $this->ensureRoomIsNotBookedForThatTime($appointment);

        $this->appointments->attach($appointment);
    }

    public function __toString() : String
    {
        $result = [];
        foreach ($this->appointments as $appointment) {
            /** @var Appointment $appointment */
            $result[] = $appointment->__toString();
        }
        return implode(PHP_EOL, $result);
    }

    /**
     * @param RoomCollection $rooms
     */
    private function ensureThereIsAtLeastOneRoom(RoomCollection $rooms)
    {
        if ($rooms->count() < 1) {
            throw new InvalidArgumentException('Schedule has to be for at least one room');
        }
    }

    /**
     * @param Appointment $appointment
     */
    private function ensureAppointmentRoomIsBookable(Appointment $appointment)
    {
        if (!$this->rooms->contains($appointment->room())) {
            throw new InvalidArgumentException('This schedule is not for the room of this appointment');
        }
    }

    private function ensureRoomIsNotBookedForThatTime(Appointment $newAppointment)
    {
        foreach ($this->appointments as $appointment) {
            /** @var Appointment $appointment */
            $bla = $appointment->room()->equals($newAppointment->room());
            if ($appointment->room()->equals($newAppointment->room())
                && $this->appointmentsTimesConflict($appointment, $newAppointment)) {
                throw new InvalidArgumentException('Room is already booked for that time');
            }
        }
    }

    private function appointmentsTimesConflict(Appointment $appointment, Appointment $newAppointment) : bool
    {
        // new appointment starts somewhere in the middle of an existing appointment
        $startsAfter = $this->dateIsBeforeOtherDate($appointment->beginsAt(),
            $newAppointment->beginsAt());
        $startsBeforeEnd = $this->dateIsBeforeOtherDate($newAppointment->beginsAt(),
            $appointment->endsAt());
        if ($startsAfter
            && $startsBeforeEnd
        ) {
            return true;
        }
        // new appointment ends somewhere in the middle of an existing appointment
        $endsAfterStart = $this->dateIsBeforeOtherDate($appointment->beginsAt(),
            $newAppointment->endsAt());
        $startsBeforeEnd = $this->dateIsBeforeOtherDate($newAppointment->endsAt(),
            $appointment->endsAt());
        if ($endsAfterStart
            && $startsBeforeEnd
        ) {
            return true;
        }
        return false;
    }

    private function dateIsBeforeOtherDate(DateTimeImmutable $before, DateTimeImmutable $after) : bool
    {
        return $before->diff($after)->invert === 1;
    }
}

