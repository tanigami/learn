<?php

namespace Shippinno\Learn\Application\Query;

use Shippinno\Learn\Application\DataTransformer\CourseDataTransformer;
use Shippinno\Learn\Domain\Model\Course\Course;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;

class AllCoursesQueryHandler implements QueryHandler
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    /**
     * @var CourseDataTransformer
     */
    private $courseDataTransformer;

    /**
     * @param CourseRepository $courseRepository
     * @param CourseDataTransformer $courseDataTransformer
     */
    public function __construct(
        CourseRepository $courseRepository,
        CourseDataTransformer $courseDataTransformer
    ) {
        $this->courseRepository = $courseRepository;
        $this->courseDataTransformer = $courseDataTransformer;
    }

    /**
     * @param AllCoursesQuery $query
     * @return mixed
     */
    public function handle($query)
    {


        return array_map(function (Course $course) {
            $this->courseDataTransformer->write($course);

            return $this->courseDataTransformer->read();
        }, $this->courseRepository->all());
    }
}
