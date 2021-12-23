<?php

namespace App\Core\Shared\Domain\Event;

interface AggregateRootInterface
{
    /**
     * @return AsyncDomainEventInterface[]
     */
    public function releaseEvents(): array;

    public function getChildEntities(): \Generator;
}