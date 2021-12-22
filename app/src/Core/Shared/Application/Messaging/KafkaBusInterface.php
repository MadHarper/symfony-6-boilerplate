<?php

namespace App\Core\Shared\Application\Messaging;

use App\Core\Shared\Domain\Event\AsyncKafkaInterface;

interface KafkaBusInterface
{
    public function dispatch(AsyncKafkaInterface $command, array $stamps = []): void;
}