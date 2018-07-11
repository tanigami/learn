<?php

namespace Shippinno\Learn\Application\Query;

class SessionsOfCourseQuery implements Query
{
    /**
     * @var string
     */
    private $courseId;

    /**
     * @param string $contractId
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