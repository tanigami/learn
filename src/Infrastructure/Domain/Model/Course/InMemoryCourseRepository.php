<?php

namespace Shippinno\Learn\Infrastructure\Domain\Model\Course;

use Shippinno\Learn\Domain\Model\Course\Course;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;

class InMemoryCourseRepository implements CourseRepository
{
    /**
     * @var Course[]
     */
    private $courses;

    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->courses;
    }

    /**
     * {@inheritdoc}
     */
    public function courseOfId(CourseId $courseId): ?Course
    {
        return $this->courses[$courseId->id()] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function add(Course $course): void
    {
        $this->courses[$course->courseId()->id()] = $course;
    }
}
