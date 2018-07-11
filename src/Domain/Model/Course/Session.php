<?php

namespace Shippinno\Learn\Domain\Model\Course;

use DateTimeImmutable;
use Tanigami\ValueObjects\Time\TimeRange;

class Session
{
    /**
     * @var SessionId
     */
    private $sessionId;

    /**
     * @var CourseId
     */
    private $courseId;

    /**
     * @var string
     */
    private $title;

    /**
     * @var TimeRange
     */
    private $hours;

    /**
     * @param SessionId $sessionId
     * @param CourseId $courseId
     * @param string $title
     */
    public function __construct(
        SessionId $sessionId,
        CourseId $courseId,
        string $title,
        TimeRange $hours
    ) {
        $this->sessionId = $sessionId;
        $this->courseId = $courseId;
        $this->title = $title;
        $this->hours = $hours;
    }

    /**
     * @return SessionId
     */
    public function sessionId(): SessionId
    {
        return $this->sessionId;
    }

    /**
     * @return CourseId
     */
    public function courseId(): CourseId
    {
        return $this->courseId;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return $this->title;
    }

    /**
     * @return TimeRange
     */
    public function hours(): TimeRange
    {
        return $this->hours;
    }

    public function isOpen(): bool
    {
        $now = $this->now();

        return $this->hours()->start() <= $now && $now <= $this->hours()->end();
    }

    /**
     * @return DateTimeImmutable
     */
    protected function now(): DateTimeImmutable
    {
        return new DateTimeImmutable;
    }
}
