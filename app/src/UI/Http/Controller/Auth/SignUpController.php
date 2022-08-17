<?php

namespace App\UI\Http\Controller\Auth;

use App\Core\Auth\Application\Request\SignUpRequest;
use App\Core\Auth\Domain\Service\SignUpService;
use App\Core\Shared\Application\Request\RequestData;
use Symfony\Component\Routing\Annotation\Route;

class SignUpController
{
    public function __construct(private SignUpService $signUpService)
    {
    }

    /**
     * @Route("/auth/sign-up/", name="sign-up", methods={"POST"})
     */
    public function signUp(#[RequestData] SignUpRequest $data)
    {
        $this->signUpService->signUp($data);

        dd(999);
    }
}