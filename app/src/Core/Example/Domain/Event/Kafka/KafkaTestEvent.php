<?php

namespace App\Core\Example\Domain\Event\Kafka;

use App\Core\Shared\Domain\Event\AbstractKafkaEvent;
use App\Core\Shared\Domain\Event\AsyncKafkaInterface;

class KafkaTestEvent extends AbstractKafkaEvent
{
    public function __construct(private string $id, private string $description)
    {

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}