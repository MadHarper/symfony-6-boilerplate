<?php

namespace App\Core\Example\Application\Command\Email;

use App\Core\Shared\Application\Messaging\CommandInterface;

class EmailCommand implements CommandInterface
{
    public function __construct(public string $email) {}
}