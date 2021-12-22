<?php

namespace App\Core\Example\Domain\Repository;

use App\Core\Example\Domain\Entity\Baz;

interface BazRepositoryInterface
{
    public function find(int $id): ?Baz;

    public function save(Baz $baz): void;

    public function register(Baz $baz): void;
}