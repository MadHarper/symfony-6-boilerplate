<?php

namespace App\Core\Example\Domain\Event\Kafka;

use App\Core\Shared\Application\Messaging\KafkaHandlerInterface;
use Psr\Log\LoggerInterface;

class KafkaTestHandler implements KafkaHandlerInterface
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(KafkaTestEvent $event)
    {
        $this->logger->info("K_A_F_K_A!!!");

        //throw new \DomainException('FFFFF');
        //dd(2);
    }
}