<?php

namespace Shippinno\Learn\Domain\Model\Course;

class SessionBelongsToCourseSpecification extends SessionSpecification
{
    /**
     * @var CourseId
     */
    private $courseId;

    /**
     * @param CourseId $courseId
     */
    public function __construct(CourseId $courseId)
    {
        $this->courseId = $courseId;
    }

    /**
     * @param Session $session
     * @return bool
     */
    public function isSatisfiedBy($session): bool
    {
        return $session->courseId()->equals($this->courseId);
    }
}