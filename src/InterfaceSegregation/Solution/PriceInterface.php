<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Solution;

interface PriceInterface
{
    public function getPrice(): float;
}