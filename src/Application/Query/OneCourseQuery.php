<?php

namespace Shippinno\Learn\Application\Query;

class OneCourseQuery implements Query
{
    /**
     * @var string
     */
    private $courseId;

    /**
     * @param string $courseId
     */
    public function __construct(string $courseId)
    {
        $this->courseId = $courseId;
    }

    /**
     * @return string
     */
    public function courseId(): string
    {
        return $this->courseId;
    }
}
