<?php

namespace App\Core\Shared\Infrastructure\Persistent;

use App\Core\Shared\Domain\Persistent\FlusherInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

class Flusher implements FlusherInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function flush(): void
    {
        $this->em->flush();
    }

    public function persist(object $object): void
    {
        $this->em->persist($object);
    }

    public function remove(object $object): void
    {
        $this->em->remove($object);
    }

    public function clear(): void
    {
        $this->em->clear();
    }

    public function refresh(object $object): void
    {
        $this->em->refresh($object);
    }

    public function getRepository(string $className): ObjectRepository|EntityRepository
    {
        return $this->em->getRepository($className);
    }
}