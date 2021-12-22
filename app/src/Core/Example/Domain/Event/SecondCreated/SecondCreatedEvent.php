<?php

namespace App\Core\Example\Domain\Event\SecondCreated;

use App\Core\Example\Domain\Entity\Second;
use App\Core\Shared\Domain\Event\AsyncDomainEventInterface;

class SecondCreatedEvent implements AsyncDomainEventInterface
{
    private string $newSecondName;

    public function __construct(Second $second)
    {
        $this->newSecondName = $second->getName()->getName();
    }

    public function getNewSecondName(): string
    {
        return $this->newSecondName;
    }
}