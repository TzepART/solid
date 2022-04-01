<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Problem;

interface PriceInterface
{
    public function getPrice(): float;
    public function getDiscount(): float;
    public function getAdditionalPrice(): float;
}