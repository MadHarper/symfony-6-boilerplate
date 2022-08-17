<?php

namespace App\Core\Auth\Domain\Service;

use App\Core\Auth\Application\Request\SignUpRequest;
use App\Core\Auth\Domain\Entity\User;
use App\Core\Auth\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SignUpService
{
    public function __construct(
        private UserPasswordHasherInterface $hasher,
        private UserRepository $repository,
        private EntityManagerInterface $em
    ) {
    }

    public function signUp(SignUpRequest $request)
    {
        if ($this->repository->existsByEmail($request->getEmail())) {
            throw new \DomainException('User already exists');
        }

        $user = (new User())
            ->setEmail($request->getEmail());

        $user->setPassword($this->hasher->hashPassword($user, $request->getPassword()));

        $this->em->persist($user);
        $this->em->flush();
    }
}