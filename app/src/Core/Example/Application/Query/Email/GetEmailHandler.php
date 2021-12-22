<?php

namespace App\Core\Example\Application\Query\Email;

use App\Core\Shared\Application\Messaging\QueryHandlerInterface;
use App\Core\Example\Infrastructure\SQL\SQLConnection;
use App\Core\Example\Infrastructure\SQL\BazQuery;

class GetEmailHandler implements QueryHandlerInterface
{
    private SQLConnection $connection;

    public function __construct(SQLConnection $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(GetEmailQuery $query): string
    {
        //return $query->id . ' : some@email.ru';

        $result = $this->connection->execute(new BazQuery(2, null, [1,2,3,4]));

        dd($result->fetchAllAssociative());
    }
}