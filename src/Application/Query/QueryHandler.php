<?php

namespace Shippinno\Learn\Application\Query;

interface QueryHandler
{
    /**
     * @param Query $query
     * @return mixed
     */
    public function handle($query);
}