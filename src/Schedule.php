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

        $this->appointments->attach($appointment);
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
}

