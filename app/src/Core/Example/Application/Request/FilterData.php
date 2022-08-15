<?php

namespace App\Core\Example\Application\Request;

use Symfony\Component\Validator\Constraints\NotBlank;

class FilterData
{
    #[NotBlank]
    private string $id;

    #[NotBlank]
    private mixed $value;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): void
    {
        $this->value = $value;
    }
}