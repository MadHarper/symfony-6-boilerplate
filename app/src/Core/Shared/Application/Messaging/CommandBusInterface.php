<?php

namespace App\Core\Shared\Application\Messaging;

interface CommandBusInterface
{
    public function dispatch(CommandInterface $command): void;
}