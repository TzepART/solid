<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Problem;

class DiscountItem implements PriceInterface
{
    public function __construct(
        private float $price,
        private float $discount
    ){}

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function getAdditionalPrice(): float
    {
        return 0.0;
    }
}