<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Solution;

class SimpleItem implements PriceInterface
{
    public function __construct(private float $price)
    {}

    public function getPrice(): float
    {
        return $this->price;
    }
}