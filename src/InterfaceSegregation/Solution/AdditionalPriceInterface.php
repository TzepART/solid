<?php

declare(strict_types=1);

namespace App\InterfaceSegregation\Solution;

interface AdditionalPriceInterface
{
    public function getAdditionalPrice(): float;
}