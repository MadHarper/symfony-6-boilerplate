<?php

namespace App\Core\Example\Application\Request;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

class EmailData
{
    #[Email]
    #[NotBlank]
    private string $email;

    // "date": "16-08-2022"
    #[NotBlank]
    private \DateTimeImmutable $date;

    /**
     * @Assert\All({
     *     @Assert\Type(type="int")
     * })
     */
    private array $ids = [];

    /**
     * @var FilterData[]
     * @Assert\Valid
     */
    private array $filters = [];

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): void
    {
        $this->date = $date;
    }

    public function getIds(): array
    {
        return $this->ids;
    }

    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }

    public function getFilters(): array
    {
        return $this->filters;
    }

    public function setFilters(array $filters): void
    {
        $this->filters = $filters;
    }
}