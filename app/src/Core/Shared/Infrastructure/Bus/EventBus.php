<?php

namespace App\Core\Shared\Infrastructure\Bus;

use App\Core\Shared\Application\Messaging\EventBusInterface;
use App\Core\Shared\Domain\Event\AsyncDomainEventInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class EventBus implements EventBusInterface
{
    public function __construct(private MessageBusInterface $eventMessageBus) {}

    public function dispatch(AsyncDomainEventInterface $event, array $stamps = []): void
    {
        $this->eventMessageBus->dispatch($event, $stamps);
    }
}