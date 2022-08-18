<?php

namespace App\Core\Auth\Domain\Service;

use App\Core\Auth\Application\Request\SignUpRequest;
use App\Core\Auth\Domain\Entity\User;
use App\Core\Auth\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $repository,
        private EntityManagerInterface $em,
        private AuthenticationSuccessHandler $successHandler
    ) {
    }

    public function signUp(SignUpRequest $request): Response
    {
        if ($this->repository->existsByEmail($request->getEmail())) {
            throw new \DomainException('User already exists');
        }

        $user = (new User())
            ->setEmail($request->getEmail());

        $user->setPassword($this->hasher->hashPassword($user, $request->getPassword()));

        $this->em->persist($user);
        $this->em->flush();

        return $this->successHandler->handleAuthenticationSuccess($user);
    }
}