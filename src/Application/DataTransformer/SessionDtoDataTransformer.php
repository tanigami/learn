<?php

namespace Shippinno\Learn\Application\DataTransformer;

use Shippinno\Learn\Domain\Model\Course\Session;

class SessionDtoDataTransformer implements SessionDataTransformer
{
    /**
     * @var Session
     */
    private $session;

    /**
     * {@inheritdoc}
     */
    public function write(Session $session): void
    {
        $this->session = $session;
    }

    /**
     * @return array
     */
    public function read(): array
    {
        return [
            'id' => $this->session->sessionId()->id(),
            'title' => $this->session->title(),
            'start' => $this->session->hours()->start(),
            'end' => $this->session->hours()->end(),
            'is_open' => $this->session->isOpen(),
        ];
    }
}