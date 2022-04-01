<?php

declare(strict_types=1);

namespace App\DependencyInversion\Solution;

interface DataProviderInterface
{
    public function save(mixed $object): void;
    public function findByField(string $field, string $value): mixed;
}