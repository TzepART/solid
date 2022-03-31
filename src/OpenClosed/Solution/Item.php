<?php

declare(strict_types=1);

namespace App\OpenClosed\Solution;

class Item implements ResultPriceInterface
{
    public function __construct(
        private float $price
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getResultPrice(): float
    {
        return $this->getPrice();
    }
}