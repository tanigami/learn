<?php

namespace Shippinno\Learn\Infrastructure\Domain\Model\Course;

use Doctrine\ORM\EntityRepository;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\Session;
use Shippinno\Learn\Domain\Model\Course\SessionId;
use Shippinno\Learn\Domain\Model\Course\SessionRepository;

class DoctrineSessionRepository extends EntityRepository implements SessionRepository
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
    public function sessionOfId(SessionId $sessionId): ?Session
    {
        /** @var Session|null $session */
        $session = $this->find($sessionId);

        return $session;
    }

    /**
     * {@inheritdoc}
     */
    public function sessionsOfCourseId(CourseId $courseId): array
    {
        return $this->findBy(['courseId' => $courseId]);
    }

    /**
     * {@inheritdoc}
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(Session $session): void
    {
        $this->getEntityManager()->persist($session);
    }
}