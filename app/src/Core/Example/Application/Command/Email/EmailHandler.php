<?php

namespace App\Core\Example\Application\Command\Email;

use App\Core\Example\Domain\Entity\Baz;
use App\Core\Example\Domain\Entity\Embedded\BazAge;
use App\Core\Example\Domain\Entity\Embedded\BazName;
use App\Core\Example\Domain\Entity\Embedded\SecondName;
use App\Core\Example\Domain\Entity\Second;
use App\Core\Example\Domain\Repository\BazRepositoryInterface;
use App\Core\Shared\Application\Messaging\CommandHandlerInterface;
use JetBrains\PhpStorm\NoReturn;

class EmailHandler implements CommandHandlerInterface
{
    public function __construct(private BazRepositoryInterface $bazRepository)
    {
    }

    #[NoReturn]
    public function __invoke(EmailCommand $command): void
    {
        $baz = new Baz(
            new BazName('Jack'),
            new BazAge(30)
        );

        $second = new Second(
            new SecondName(18)
        );

        $baz->addSecond($second);

        $this->bazRepository->register($baz);

        dd($command);
    }
}