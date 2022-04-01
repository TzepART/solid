<?php

declare(strict_types=1);

namespace App\DependencyInversion\Solution;

class Order
{
    public function __construct(private string $code)
    {}

    public function getCode(): string
    {
        return $this->code;
    }
}