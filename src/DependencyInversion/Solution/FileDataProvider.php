<?php

declare(strict_types=1);

namespace App\DependencyInversion\Solution;

class FileDataProvider implements DataProviderInterface
{
    public function __construct()
    {
        // There is connection to DB
    }

    public function save(mixed $object): void
    {
        // save Order to DB
    }

    public function findByField(string $field, string $value): mixed
    {
        return null;
    }
}