<?php

namespace App\Core\Shared\Application\Request;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestDataResolver implements ArgumentValueResolverInterface
{
    public function __construct(private SerializerInterface $serializer, private ValidatorInterface $validator)
    {
    }

    public function supports(Request $request, ArgumentMetadata $argument): bool
    {
        return count($argument->getAttributes(RequestData::class, ArgumentMetadata::IS_INSTANCEOF)) > 0;
    }

    public function resolve(Request $request, ArgumentMetadata $argument): ?\Generator
    {
        try {
            $model = $this->serializer->deserialize($request->getContent(), $argument->getType(), JsonEncoder::FORMAT);
        } catch (\Throwable $e) {
            throw new \DomainException("asdasd");
        }

        $errors = $this->validator->validate($model);
        if (count($errors) > 0) {
            throw new \DomainException($errors);
        }

        dd($model);

        yield $model;
    }
}