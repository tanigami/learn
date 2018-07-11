<?php

namespace Shippinno\Learn\Application\DataTransformer;

use Shippinno\Learn\Domain\Model\Course\Session;

interface SessionDataTransformer
{
    /**
     * @param Session $session
     */
    public function write(Session $session): void;

    /**
     * @return mixed
     */
    public function read();
}