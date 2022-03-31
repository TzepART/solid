<?php

declare(strict_types=1);

namespace App\OpenClosed\Solution;

class ItemWithAdditionalPrice implements ResultPriceInterface
{
    public function __construct(
        private float $price,
        private float $additionalPrice
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getAdditionalPrice(): float
    {
        return $this->additionalPrice;
    }

    public function getResultPrice(): float
    {
        return $this->getPrice() + $this->getPrice();
    }
}