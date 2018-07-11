<?php

namespace Shippinno\Learn\Infrastructure\Domain\Model\Course;

use Shippinno\Learn\Domain\Model\Course\Session;
use Shippinno\Learn\Domain\Model\Course\SessionId;

class InMemorySessionRepository
{
    /**
     * @var Session[]
     */
    private $sessions;

    /**
     * {@inheritdoc}
     */
    public function sessionOfId(SessionId $sessionId): ?Session
    {
        return $this->sessions[$sessionId->id()] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function add(Session $session): void
    {
        $this->sessions[$session->sessionId()->id()] = $session;
    }
}