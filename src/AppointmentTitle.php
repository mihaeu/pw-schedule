<?php declare(strict_types = 1);

class AppointmentTitle
{
    /**
     * @var string
     */
    private $title;

    /**
     * AppointmentTitle constructor.
     * @param string $title
     */
    public function __construct($title)
    {
        $this->ensureTitleIsNotEmpty($title);

        $this->title = $title;
    }

    public function __toString() : string
    {
        return $this->title;
    }

    /**
     * @param $title
     */
    private function ensureTitleIsNotEmpty($title)
    {
        if (empty($title)) {
            throw new InvalidArgumentException('Title cannot be empty');
        }
    }
}

