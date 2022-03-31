<?php

declare(strict_types=1);

namespace App\LiskovSubstitution\Problem;

class PriceCalculatorWithDiscount extends PriceCalculator
{
    private float $discount = 0.0;

    public function calculateItemsPrices(): float
    {
        return parent::calculateItemsPrices() * (1 - $this->getDiscount());
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }
}