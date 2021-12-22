<?php

namespace App\Core\Shared\Application\Messaging;

use App\Core\Shared\Domain\Event\AsyncDomainEventInterface;

interface EventBusInterface
{
    public function dispatch(AsyncDomainEventInterface $event, array $stamps): void;
}