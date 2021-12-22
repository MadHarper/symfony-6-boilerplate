<?php

declare(strict_types=1);

namespace App\UI\Http\Controller;

use App\Core\Shared\Application\Messaging\CommandBusInterface;

abstract class CommandController
{
    public function __construct(protected CommandBusInterface $commandBus) {}
}