<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Application\Query\Email\GetEmailQuery;
use App\Core\Example\Domain\Entity\Baz;
use App\Core\Example\Domain\Entity\Embedded\BazAge;
use App\Core\Example\Domain\Entity\Embedded\BazName;
use App\Core\Example\Domain\Entity\Embedded\SecondName;
use App\Core\Example\Domain\Entity\Second;
use App\Core\Example\Domain\Repository\BazRepositoryInterface;
use App\UI\Http\Controller\QueryController;
use App\UI\Http\Schema\BazSchema;
use App\UI\Http\Schema\JWTTokenDTO;
use App\UI\Http\Schema\JWTTokenSchema;
use App\UI\Http\Schema\NeomerxError;
use Neomerx\JsonApi\Encoder\Encoder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface;
use Symfony\Component\Workflow\WorkflowInterface;
use Symfony\Component\Workflow\Registry;
use Symfony\Component\DependencyInjection\ContainerInterface;
use JMS\Serializer\SerializerInterface;

class ExampleQueryController extends QueryController implements LoggerAwareInterface
{
    private LoggerInterface $logger;

    /**
     * @Route("/example_query/", name="example_query", methods={"GET"})
     */
    public function exampleAction(Request $request): Response
    {
        dd(777);
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
        $baz = $bazRepository->find(52);

        return new Response($encoder->encodeData($baz));
    }

    /**
     * @Route("/example_neomerx_jwt/", name="example_neomerx_jwt")
     */
    public function exampleNeomerxJwt(Request $request): Response
    {
        $encoder = Encoder::instance([JWTTokenDTO::class => JWTTokenSchema::class]);
        $token = new JWTTokenDTO('1wdqkjwd1', 'asd');

        return new Response($encoder->encodeData($token));
    }

    /**
     * @Route("/example_neomerx_error/", name="example_neomerx_error")
     */
    public function exampleNeomerxError(Request $request): Response
    {
        $encoder = Encoder::instance([JWTTokenDTO::class => JWTTokenSchema::class]);
        $token = new JWTTokenDTO('1wdqkjwd1', 'asd');

        return new Response($encoder->encodeError(new NeomerxError()));
    }

    /**
     * @Route("/example_workflow/", name="example_workflow")
     */
    public function exampleWorkflow(Request $request, BazRepositoryInterface $bazRepository, WorkflowInterface $shiftAdminPublishingStateMachine, Registry $registry): Response
    {
//        $baz = new Baz(
//            new BazName('Jack'),
//            new BazAge(30)
//        );
//
//        $second = new Second(new SecondName('Gilbert'));
//
//        $baz->addSecond($second);
//
//        $bazRepository->register($baz);

        $baz = $bazRepository->find(52);

        //dd($shiftAdminPublishingStateMachine->getMarking($baz)->getPlaces());
        dd($shiftAdminPublishingStateMachine->getMetadataStore()->getPlaceMetadata('coming_out'));
        $shiftAdminPublishingStateMachine->apply($baz, 'jump_to_coming_out');

//        $workflow = $registry->get($baz);
//        $workflow->apply($baz, 'to_coming_out');

        $bazRepository->save($baz);
        dd(1);
    }

    /**
     * @Route("/serializer/", name="serializer")
     */
    public function serializerTest(BazRepositoryInterface $bazRepository, ContainerInterface $container, SerializerInterface $serializer)
    {
        dd($serializer);
        dd($container->get('jms_serializer'));
        $baz = $bazRepository->find(52);

    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}