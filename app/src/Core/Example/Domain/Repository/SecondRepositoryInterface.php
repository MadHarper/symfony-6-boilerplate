<?php

namespace App\Core\Example\Domain\Repository;

use App\Core\Example\Domain\Entity\Baz;
use App\Core\Example\Domain\Entity\Second;

interface SecondRepositoryInterface
{
    public function get(int $id): Second;

    public function store(Baz $baz): void;

}