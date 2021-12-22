<?php

namespace App\Core\Example\Domain\Entity;

use App\Core\Example\Domain\Entity\Embedded\BazAge;
use App\Core\Example\Domain\Entity\Embedded\BazName;
use App\Core\Example\Domain\Event\BazCreated\BazCreatedEvent;
use App\Core\Example\Domain\Repository\BazRepositoryInterface;
use App\Core\Shared\Domain\Event\AggregateRootInterface;
use App\Core\Shared\Domain\Event\EventTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Broadway\EventSourcing\EventSourcedAggregateRoot;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity()
 */
class Baz implements AggregateRootInterface
{
    use EventTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var BazName
     * @ORM\Embedded(class="App\Core\Example\Domain\Entity\Embedded\BazName", columnPrefix = "name_")
     */
    private $name;

    /**
     * @var BazAge
     * @ORM\Embedded(class="App\Core\Example\Domain\Entity\Embedded\BazAge", columnPrefix = "age_")
     */
    private $age;

    /**
     * @var Second[]|Collection
     * @ORM\OneToMany(targetEntity="Second", mappedBy="baz", cascade={"all"}, orphanRemoval=true)
     */
    private $seconds;

    #[Pure]
    public function __construct(BazName $name, BazAge $age)
    {
        $this->name = $name;
        $this->age = $age;
        $this->seconds = new ArrayCollection();

        $this->recordEvent(new BazCreatedEvent($this));
    }

    public function getChildEntities(): \Generator
    {
        yield from $this->seconds;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): BazName
    {
        return $this->name;
    }

    public function getAge(): BazAge
    {
        return $this->age;
    }

    public function getSeconds(): Collection
    {
        return $this->seconds;
    }

    public function addSecond(Second $second): self
    {
        if (!$this->seconds->contains($second)) {
            $this->seconds[] = $second;
            $second->setBaz($this);
        }

        return $this;
    }
}
