<?php

namespace App\Core\Example\Domain\Event\BazCreated;

use App\Core\Example\Domain\Entity\Baz;
use App\Core\Shared\Domain\Event\AsyncDomainEventInterface;

class BazCreatedEvent implements AsyncDomainEventInterface
{
    private string $newBazName;

    public function __construct(Baz $baz)
    {
        $this->newBazName = $baz->getName()->getName();
    }

    public function getNewBazName(): string
    {
        return $this->newBazName;
    }
}