<?php declare(strict_types = 1);

class Appointment
{
    /**
     * @var DateTimeImmutable
     */
    private $beginsAt;

    /**
     * @var DateTimeImmutable
     */
    private $endsAt;

    /**
     * @var AppointmentTitle
     */
    private $title;

    /**
     * @var Room
     */
    private $room;

    /**
     * @var UserCollection
     */
    private $participants;

    /**
     * Appointment constructor.
     * @param DateTimeImmutable $beginsAt
     * @param DateTimeImmutable $endsAt
     * @param AppointmentTitle $title
     * @param Room $room
     * @param UserCollection $participants
     */
    public function __construct(
        DateTimeImmutable $beginsAt,
        DateTimeImmutable $endsAt,
        AppointmentTitle $title,
        Room $room,
        UserCollection $participants
    ) {
        $this->ensureStartIsBeforeEnd($beginsAt, $endsAt);
        $this->ensureThereIsAtLeastOneParticipant($participants);

        $this->beginsAt = $beginsAt;
        $this->endsAt = $endsAt;
        $this->title = $title;
        $this->room = $room;
        $this->participants = $participants;
    }

    /**
     * @param UserCollection $participants
     */
    private function ensureThereIsAtLeastOneParticipant(
        UserCollection $participants
    ) {
        if ($participants->count() < 1) {
            throw new InvalidArgumentException('Appointment must have at least one participant');
        }
    }

    /**
     * @param DateTimeImmutable $beginsAt
     * @param DateTimeImmutable $endsAt
     */
    private function ensureStartIsBeforeEnd(
        DateTimeImmutable $beginsAt,
        DateTimeImmutable $endsAt
    ) {
        if ($beginsAt->diff($endsAt)->invert === 1) {
            throw new InvalidArgumentException('Beginning has to be before end');
        }
    }
}
