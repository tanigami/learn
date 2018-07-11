<?php

namespace Shippinno\Learn\Application\Service;

use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;
use Shippinno\Learn\Domain\Model\Course\SessionRepository;

class AddSessionToCourseService
{
    /**
     * @var CourseRepository
     */
    private $courseRepository;

    /**
     * @var SessionRepository
     */
    private $sessionRepository;

    /**
     * @param CourseRepository $courseRepository
     * @param SessionRepository $sessionRepository
     */
    public function __construct(
        CourseRepository $courseRepository,
        SessionRepository $sessionRepository
    ) {
        $this->courseRepository = $courseRepository;
        $this->sessionRepository = $sessionRepository;
    }

    /**
     * @param AddSessionToCourseRequest $request
     */
    public function execute($request)
    {
        $course = $this->courseRepository->courseOfId(new CourseId($request->courseId()));
        $session = $course->addSession($request->title(), $request->hours());
        $this->sessionRepository->add($session);
    }
}