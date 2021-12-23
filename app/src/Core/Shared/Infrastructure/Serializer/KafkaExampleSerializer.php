<?php

namespace App\Core\Shared\Infrastructure\Serializer;

use App\Core\Example\Domain\Event\Kafka\KafkaTestEvent;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Transport\Serialization\SerializerInterface;

class KafkaExampleSerializer implements SerializerInterface
{
    public function decode(array $encodedEnvelope): Envelope
    {
        $record = json_decode($encodedEnvelope['body'], true);

        return new Envelope(
            new KafkaTestEvent($record['id'], $record['description'])
        );
    }

    public function encode(Envelope $envelope): array
    {
        /** @var KafkaTestEvent $event */
        $event = $envelope->getMessage();

        return [
            'key' => $event->getId(),
            'body' => json_encode([
                'id' => $event->getId(),
                'description' => $event->getDescription(),
            ]),
        ];
    }
}