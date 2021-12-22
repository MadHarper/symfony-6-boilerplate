<?php

namespace App\Core\Shared\Domain\Persistent;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;

interface FlusherInterface
{
    public function flush(): void;

    public function persist(object $object): void;

    public function remove(object $object): void;

    public function clear(): void;

    public function refresh(object $object): void;

    public function getRepository(string $className): ObjectRepository|EntityRepository;
}