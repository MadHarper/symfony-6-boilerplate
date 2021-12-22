<?php

namespace App\Core\Shared\Domain\Event;

trait EventTrait
{
    /** @var AsyncDomainEventInterface[]  */
    private array $events = [];

    public function recordEvent(AsyncDomainEventInterface $event): void
    {
        $this->events[] = $event;
    }

    /**
     * @return AsyncDomainEventInterface[]
     */
    public function releaseEvents(): array
    {
        $releasedEvents = $this->events;
        $this->events = [];

        return $releasedEvents;
    }
}