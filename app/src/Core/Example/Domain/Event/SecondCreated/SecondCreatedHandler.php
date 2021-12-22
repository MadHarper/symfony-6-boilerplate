<?php

namespace App\Core\Example\Domain\Event\SecondCreated;

use App\Core\Shared\Application\Messaging\EventHandlerInterface;

class SecondCreatedHandler implements EventHandlerInterface
{
    public function __construct(private string $rootPath)
    {
    }

    public function __invoke(SecondCreatedEvent $event): void
    {
        $filePath = $this->rootPath . '/var/log/' . 'second_log.txt';

        file_put_contents($filePath, $event->getNewSecondName(), FILE_APPEND);
    }
}