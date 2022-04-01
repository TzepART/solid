<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Problem;

class SimpleItem implements PriceInterface
{
    public function __construct(private float $price)
    {}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return 0.0;
    }

    public function getAdditionalPrice(): float
    {
        return 0.0;
    }
}