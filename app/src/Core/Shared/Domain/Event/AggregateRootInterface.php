<?php

namespace App\Core\Shared\Domain\Event;

interface AggregateRootInterface
{
    /**
     * @return AsyncDomainEventInterface[]
     */
    public function releaseEvents(): array;

    /**
     * @return AggregateRootInterface[]
     */
    public function getChildEntities(): \Generator;
}