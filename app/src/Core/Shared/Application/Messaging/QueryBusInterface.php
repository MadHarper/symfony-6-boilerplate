<?php

namespace App\Core\Shared\Application\Messaging;

interface QueryBusInterface
{
    public function dispatch(QueryInterface $query): mixed;
}