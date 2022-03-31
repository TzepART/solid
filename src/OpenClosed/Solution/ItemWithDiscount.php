<?php

declare(strict_types=1);

namespace App\OpenClosed\Solution;

class ItemWithDiscount implements ResultPriceInterface
{
    public function __construct(
        private float $price,
        private float $discount = 0.0
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getResultPrice(): float
    {
        return $this->getPrice() * (1 - $this->getDiscount());
    }
}