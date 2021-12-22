<?php

namespace App\Core\Example\Application\Query\Email;

use App\Core\Shared\Application\Messaging\QueryInterface;

class GetEmailQuery implements QueryInterface
{
    public function __construct(public int $id) {}
}