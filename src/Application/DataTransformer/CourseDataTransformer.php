<?php

namespace Shippinno\Learn\Application\DataTransformer;

use Shippinno\Learn\Domain\Model\Course\Course;

interface CourseDataTransformer
{
    /**
     * @param Course $course
     */
    public function write(Course $course): void;

    /**
     * @return mixed
     */
    public function read();
}