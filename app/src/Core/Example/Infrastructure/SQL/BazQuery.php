<?php

namespace App\Core\Example\Infrastructure\SQL;

class BazQuery
{
    private int $id;
    private ?string $name;
    private array $ids;

    public function __construct(int $id, ?string $name, ?array $ids)
    {
        $this->id = $id;
        $this->name = $name;
        $this->ids = $ids;
    }

    public function __invoke(Context $context): \Generator
    {
        yield <<<SQL
                SELECT * FROM baz
                WHERE id = {$context($this->id)}
                AND id in ({$context(...$this->ids)})
            SQL;

        if ($this->name) {
            yield "AND name = {$context($this->name)}";
        }
    }
}