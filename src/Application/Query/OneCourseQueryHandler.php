<?php

namespace Shippinno\Learn\Application\Query;

use Shippinno\Learn\Application\DataTransformer\CourseDataTransformer;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;

class OneCourseQueryHandler implements QueryHandler
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
     * @param OneCourseQuery $query
     * @return mixed;
     */
    public function handle( $query)
    {
        $course = $this->courseRepository->courseOfId(new CourseId($query->courseId()));
        $this->courseDataTransformer->write($course);

        return $this->courseDataTransformer->read();
    }
}