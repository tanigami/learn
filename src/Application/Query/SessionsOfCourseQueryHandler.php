<?php

namespace Shippinno\Learn\Application\Query;

use Doctrine\ORM\EntityManager;
use Shippinno\Learn\Application\DataTransformer\SessionDataTransformer;
use Shippinno\Learn\Domain\Model\Course\CourseId;
use Shippinno\Learn\Domain\Model\Course\Session;
use Shippinno\Learn\Domain\Model\Course\SessionRepository;

class SessionsOfCourseQueryHandler implements QueryHandler
{
    /**
     * @var SessionRepository
     */
    private $sessionRepository;

    /**
     * @var SessionDataTransformer
     */
    private $sessionDataTransformer;
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param SessionRepository $sessionRepository
     * @param SessionDataTransformer $sessionDataTransformer
     */
    public function __construct(
        SessionRepository $sessionRepository,
        SessionDataTransformer $sessionDataTransformer,
        EntityManager $entityManager
    ) {
        $this->sessionRepository = $sessionRepository;
        $this->sessionDataTransformer = $sessionDataTransformer;
        $this->entityManager = $entityManager;
    }

    /**
     * @param SessionsOfCourseQuery $query
     * @return mixed
     */
    public function handle($query)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $sessions = $queryBuilder
            ->select('s')
            ->from(Session::class, 's')
            ->where($queryBuilder->expr()->eq('s.courseId', ':courseId'))
            ->setParameter('courseId', new CourseId($query->courseId()))
            ->getQuery()
            ->getResult();

        return array_map(function (Session $session) {
            $this->sessionDataTransformer->write($session);

            return $this->sessionDataTransformer->read();
        }, $sessions);
    }
}