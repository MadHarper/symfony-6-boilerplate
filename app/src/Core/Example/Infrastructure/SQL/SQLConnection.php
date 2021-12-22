<?php

namespace App\Core\Example\Infrastructure\SQL;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Result;

class SQLConnection
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function  execute(callable $statement): Result
    {
        $context = new Context();

        $resolvedStatement = implode(' ', iterator_to_array($statement($context)));
        $parameters = $context->parameters;

        return $this->connection->executeQuery($resolvedStatement, $parameters);
    }
}