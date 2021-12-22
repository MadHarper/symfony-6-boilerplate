<?php

namespace App\Core\Shared\Infrastructure\Bus;

use App\Core\Shared\Application\Messaging\QueryBusInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Core\Shared\Application\Messaging\QueryInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class QueryBus implements QueryBusInterface
{
    public function __construct(private MessageBusInterface $queryMessageBus) {}

    public function dispatch(QueryInterface $query): mixed
    {
        /** @var HandledStamp|null $stamp */
        $stamp = $this->queryMessageBus
            ->dispatch($query)
            ->last(HandledStamp::class);

        if (null === $stamp) {
            return null;
        }

        return $stamp->getResult();
    }
}