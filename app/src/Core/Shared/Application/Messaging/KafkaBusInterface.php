<?php

namespace App\Core\Shared\Application\Messaging;

use App\Core\Shared\Domain\Event\AbstractKafkaEvent;
use App\Core\Shared\Domain\Event\AsyncKafkaInterface;

interface KafkaBusInterface
{
    public function dispatch(AbstractKafkaEvent $event, array $stamps = []): void;
}