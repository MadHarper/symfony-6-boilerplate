<?php

namespace App\Core\Example\Domain\Entity\Embedded;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable
 */
class BazAge
{
    /**
     * @var string
     * @ORM\Column(type="integer", nullable=false)
     */
    private $age;

    public function __construct(int $age)
    {
        $this->age = $age;
    }

    public function getAge(): string
    {
        return $this->age;
    }
}