<?php

namespace App\Core\Shared\Infrastructure\Bus;

use App\Core\Shared\Application\Messaging\CommandBusInterface;
use App\Core\Shared\Application\Messaging\CommandInterface;
use App\Core\Shared\Application\Messaging\KafkaBusInterface;
use App\Core\Shared\Domain\Event\AsyncKafkaInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class KafkaBus implements KafkaBusInterface
{
    public function __construct(private MessageBusInterface $commandMessageBus) {}

    public function dispatch(AsyncKafkaInterface $command, $stamps = []): void
    {
        $this->commandMessageBus->dispatch($command, $stamps);
    }
}