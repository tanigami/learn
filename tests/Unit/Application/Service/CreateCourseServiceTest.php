<?php

namespace Shippinno\Learn\Tests\Unit\Application\Service;

use Shippinno\Learn\Application\Service\CreateCourseRequest;
use Shippinno\Learn\Application\Service\CreateCourseService;
use Shippinno\Learn\Infrastructure\Domain\Model\Course\InMemoryCourseRepository;

class CreateCourseServiceTest extends \PHPUnit\Framework\TestCase
{
    public function testItCreatesCourse()
    {
        $courseRepository = new InMemoryCourseRepository;
        $service = new CreateCourseService($courseRepository);
        $service->execute(new CreateCourseRequest('COURSE_NAME'));
        $this->assertCount(1, $courseRepository->all());
    }
}