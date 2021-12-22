<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Application\Query\Email\GetEmailQuery;
use App\Core\Example\Domain\Entity\Baz;
use App\Core\Example\Domain\Repository\BazRepositoryInterface;
use App\UI\Http\Controller\QueryController;
use App\UI\Http\Schema\BazSchema;
use Neomerx\JsonApi\Encoder\Encoder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;

class ExampleQueryController extends QueryController implements LoggerAwareInterface
{
    private LoggerInterface $logger;

    /**
     * @Route("/example_query/", name="example_query")
     */
    public function exampleAction(Request $request): Response
    {
        $this->logger->critical('ALARM 2!!! Hr-hr? Joke ))');

        $id = (int) $request->get('id');

        $res = $this->queryBus->dispatch(new GetEmailQuery($id));
        dd($res);
    }

    /**
     * @Route("/example_neomerx/", name="example_neomerx")
     */
    public function exampleNeomerx(Request $request, BazRepositoryInterface $bazRepository): Response
    {
        $encoder = Encoder::instance([Baz::class => BazSchema::class]);
        $baz = $bazRepository->find(36);

        return new Response($encoder->encodeData($baz));
    }


    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}