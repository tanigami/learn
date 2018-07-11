<?php

namespace Shippinno\Learn\Application\DataTransformer;

use Shippinno\Learn\Domain\Model\Course\Course;

class CourseDtoDataTransformer implements CourseDataTransformer
{
    /**
     * @var Course
     */
    private $course;

    /**
     * {@inheritdoc}
     */
    public function write(Course $course): void
    {
        $this->course = $course;
    }

    /**
     * @return array
     */
    public function read(): array
    {
        return [
            'id' => $this->course->courseId()->id(),
            'name' => $this->course->name(),
        ];
    }
}