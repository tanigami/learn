<?php

namespace Shippinno\Learn\Application\Service;

use Shippinno\Learn\Domain\Model\Course\Course;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;

class CreateCourseService
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    /**
     * @param CourseRepository $courseRepository
     */
    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * @param CreateCourseRequest $request
     */
    public function execute($request): void
    {
        $course = new Course(
            new CourseId,
            $request->name()
        );
        $this->courseRepository->add($course);
    }
}