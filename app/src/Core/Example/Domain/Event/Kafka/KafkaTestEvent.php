<?php

namespace App\Core\Example\Domain\Event\Kafka;

use App\Core\Shared\Domain\Event\AsyncKafkaInterface;

class KafkaTestEvent implements AsyncKafkaInterface
{
    public string $name = "Ulyuana";
}