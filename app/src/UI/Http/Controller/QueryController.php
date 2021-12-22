<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Core\Shared\Application\Messaging\QueryBusInterface;

abstract class QueryController
{
    public function __construct(protected QueryBusInterface $queryBus) {}
}