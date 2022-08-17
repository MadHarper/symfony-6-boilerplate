<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Application\Request\EmailData;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\Shared\Application\Request\RequestData;

class AttributeController
{
    /**
     * @Route("/attribute/", name="attribute", methods={"POST"})
     */
    public function testAttribute(#[RequestData] EmailData $data): Response
    {
        dd(111, $data);
    }
}