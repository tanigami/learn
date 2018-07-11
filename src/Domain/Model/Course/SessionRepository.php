<?php

namespace Shippinno\Learn\Domain\Model\Course;

interface SessionRepository
{
    /**
     * @return Session[]
     */
    public function all(): array;

    /**
     * @param SessionId $sessionId
     * @return null|Session
     */
    public function sessionOfId(SessionId $sessionId): ?Session;

    /**
     * @param CourseId $courseId
     * @return Session[]
     */
    public function sessionsOfCourseId(CourseId $courseId): array;

    /**
     * @param Session $session
     */
    public function add(Session $session): void;
}