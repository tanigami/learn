<?php

namespace Shippinno\Learn\Domain\Model\Course;

use DateTimeImmutable;
use Tanigami\ValueObjects\Time\TimeRange;

class Course
{
    /**
     * @var CourseId
     */
    private $courseId;

    /**
     * @var string
     */
    private $name;

    /**
     * @param CourseId $courseId
     * @param string $name
     */
    public function __construct(CourseId $courseId, string $name)
    {
        $this->courseId = $courseId;
        $this->name = $name;
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
    public function name(): string
    {
        return $this->name;
    }

    public function addSession(
        string $title,
        TimeRange $hours
    ): Session {
        return new Session(
            new SessionId,
            $this->courseId,
            $title,
            $hours
        );
    }
}
