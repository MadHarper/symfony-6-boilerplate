<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Domain\Event\Kafka\KafkaTestEvent;
use App\Core\Shared\Application\Messaging\KafkaBusInterface;
use App\Core\Shared\Infrastructure\Bus\KafkaBus;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class KafkaProducerController
{
    /**
     * @Route("/kafka/", name="kafka")
     */
    public function exampleAction(Request $request, KafkaBusInterface $bus): Response
    {
        $bus->dispatch(new KafkaTestEvent());
        dd("from Kafka Controller");
    }
}