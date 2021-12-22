<?php

namespace App\Core\Shared\Infrastructure\Bus;

use App\Core\Shared\Application\Messaging\CommandBusInterface;
use App\Core\Shared\Application\Messaging\CommandInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class CommandBus implements CommandBusInterface
{
    public function __construct(private MessageBusInterface $commandMessageBus) {}

    public function dispatch(CommandInterface $command): void
    {
        $this->commandMessageBus->dispatch($command);
    }
}