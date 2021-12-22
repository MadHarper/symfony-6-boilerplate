<?php

namespace App\Core\Example\Domain\Entity;

use App\Core\Example\Domain\Entity\Embedded\SecondName;
use App\Core\Example\Domain\Event\SecondCreated\SecondCreatedEvent;
use App\Core\Shared\Domain\Event\AggregateRootInterface;
use App\Core\Shared\Domain\Event\EventTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Second implements AggregateRootInterface
{
    use EventTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var SecondName
     * @ORM\Embedded(class="App\Core\Example\Domain\Entity\Embedded\SecondName", columnPrefix = "age_")
     */
    private $name;

    /**
     * @var Baz
     *
     * @ORM\ManyToOne(targetEntity="Baz", inversedBy="seconds")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="baz_id", referencedColumnName="id")
     * })
     */
    private $baz;

    public function __construct(SecondName $name)
    {
        $this->name = $name;

        $this->recordEvent(new SecondCreatedEvent($this));
    }

    public function getChildEntities(): \Generator
    {
        yield from [];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): SecondName
    {
        return $this->name;
    }

    public function getBaz(): Baz
    {
        return $this->baz;
    }

    public function setBaz(Baz $baz): self
    {
        $this->baz = $baz;

        return $this;
    }
}
