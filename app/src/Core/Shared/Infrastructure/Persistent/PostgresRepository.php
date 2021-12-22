<?php

namespace App\Core\Shared\Infrastructure\Persistent;

use App\Core\Shared\Application\Messaging\EventBusInterface;
use App\Core\Shared\Domain\Event\AggregateRootInterface;
use App\Core\Shared\Domain\Event\AsyncDomainEventInterface;
use Symfony\Component\Messenger\Stamp\DelayStamp;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\EntityManagerInterface;

abstract class PostgresRepository
{
    protected const DELAY_MILLISECONDS = 2000;

    protected EntityRepository $repository;

    public function __construct(protected EntityManagerInterface $em, protected EventBusInterface $bus)
    {
        $this->setEntityRepository();
    }

    abstract protected function setEntityRepository(): void;

    public function registerAndSave($model): void
    {
        $this->em->persist($model);
        $this->saveWithEvents($model);
    }

    public function saveWithEvents(object $entity): void
    {
        $this->em->flush();

        if ($entity instanceof AggregateRootInterface) {
            $this->handleEventsRecursively($entity);
        }
    }

    private function handleEventsRecursively(AggregateRootInterface $entity): void
    {
        $this->handleEvents($entity);

        foreach ($entity->getChildEntities() as $entity) {
            $this->handleEventsRecursively($entity);
        }
    }

    private function handleEvents(AggregateRootInterface $entity): void
    {
         foreach ($entity->releaseEvents() as $event) {
             $this->dispatchAsyncDomainEvent($event);
         }
    }

    private function dispatchAsyncDomainEvent(AsyncDomainEventInterface $event): void
    {
        $this->bus->dispatch($event, [new DelayStamp(static::DELAY_MILLISECONDS)]);
    }
}