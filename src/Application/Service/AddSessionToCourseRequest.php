<?php

namespace Shippinno\Learn\Application\Service;

use Tanigami\ValueObjects\Time\TimeRange;

class AddSessionToCourseRequest
{
    /**
     * @var string
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
     * @param string $courseId
     * @param string $title
     * @param TimeRange $hours
     */
    public function __construct(
        string $courseId,
        string $title,
        TimeRange $hours
    ) {
        $this->courseId = $courseId;
        $this->title = $title;
        $this->hours = $hours;
    }

    /**
     * @return string
     */
    public function courseId(): string
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
}
