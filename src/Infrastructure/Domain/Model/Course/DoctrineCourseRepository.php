<?php

namespace Shippinno\Learn\Infrastructure\Domain\Model\Course;

use Doctrine\ORM\EntityRepository;
use Shippinno\Learn\Domain\Model\Course\Course;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\CourseRepository;

class DoctrineCourseRepository extends EntityRepository implements CourseRepository
{
    /**
     * {@inheritdoc}
     */
    public function all(): array
    {
        return $this->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function courseOfId(CourseId $courseId): ?Course
    {
        /** @var Course|null $course */
        $course = $this->find($courseId);

        return $course;
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Course $course): void
    {
        $this->getEntityManager()->persist($course);
    }
}