<?php

namespace Shippinno\Learn\Domain\Model\Course;

interface CourseRepository
{
    /**
     * @return Course[]
     */
    public function all(): array;

    /**
     * @param CourseId $courseId
     * @return null|Course
     */
    public function courseOfId(CourseId $courseId): ?Course;

    /**
     * @param Course $course
     */
    public function add(Course $course): void;
}