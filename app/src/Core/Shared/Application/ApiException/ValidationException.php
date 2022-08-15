<?php

namespace App\Core\Shared\Application\ApiException;

use Symfony\Component\Validator\ConstraintViolationInterface;

class ValidationException extends \InvalidArgumentException
{
    public function __construct(private ConstraintViolationInterface $violation)
    {
        parent::__construct('validation exception');
    }

    public function getVioletions(): ConstraintViolationInterface
    {
        return $this->violation;
    }
}