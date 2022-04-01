<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Solution;

class DiscountItem implements PriceInterface, DiscountInterface
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
}