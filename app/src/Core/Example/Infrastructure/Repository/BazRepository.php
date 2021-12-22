<?php

namespace App\Core\Example\Infrastructure\Repository;

use App\Core\Example\Domain\Entity\Baz;
use App\Core\Example\Domain\Repository\BazRepositoryInterface;
use App\Core\Shared\Infrastructure\Persistent\PostgresRepository;

class BazRepository extends PostgresRepository implements BazRepositoryInterface
{
    public function find(int $id): ?Baz
    {
        return $this->repository
            ->find($id);
    }

    public function save(Baz $baz): void
    {
        $this->saveWithEvents($baz);
    }

    public function register(Baz $baz): void
    {
        $this->registerAndSave($baz);
    }

    protected function setEntityRepository(): void
    {
        $this->repository = $this->em->getRepository(Baz::class);
    }
}