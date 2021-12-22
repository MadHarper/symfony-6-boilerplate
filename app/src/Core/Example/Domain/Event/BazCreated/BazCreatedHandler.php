<?php

namespace App\Core\Example\Domain\Event\BazCreated;

use App\Core\Shared\Application\Messaging\EventHandlerInterface;

class BazCreatedHandler implements EventHandlerInterface
{
    public function __construct(private string $rootPath)
    {
    }

    public function __invoke(BazCreatedEvent $event): void
    {
        $filePath = $this->rootPath . '/var/log/' . 'baz_log.txt';
        file_put_contents($filePath, $event->getNewBazName(), FILE_APPEND);
    }
}