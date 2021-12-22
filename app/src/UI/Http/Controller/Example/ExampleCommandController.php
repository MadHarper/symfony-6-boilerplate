<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Application\Command\Email\EmailCommand;
use App\UI\Http\Controller\CommandController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ExampleCommandController extends CommandController
{
    /**
     * @Route("/example/", name="example")
     */
    public function exampleAction(Request $request): Response
    {
        $email = $request->get('email');

        $this->commandBus->dispatch(new EmailCommand($email));

        dd('end');
    }
}