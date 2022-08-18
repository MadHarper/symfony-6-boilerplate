<?php

declare(strict_types=1);

namespace App\UI\Http\Controller\Example;

use App\Core\Example\Application\Request\EmailData;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Core\Shared\Application\Request\RequestData;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Core\Auth\Domain\Entity\User;

class AttributeController extends AbstractController
{
    /**
     * @Route("/attribute/", name="attribute", methods={"POST"})
     */
    public function testAttribute(#[RequestData] EmailData $data, #[CurrentUser] ?User $user): Response
    {
        dd(111, $data, $user);
    }
}