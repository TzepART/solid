<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Solution;

interface DiscountInterface
{
    public function getDiscount(): float;
}