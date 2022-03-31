<?php

declare(strict_types=1);

namespace App\SingleResponsibility\Solution;

use App\SingleResponsibility\Item;

class PriceCalculator
{
    /**
     * @param Item[] $items
     */
    public function __construct(private array $items)
    {}

    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item->getPrice();
        }

        return $result;
    }
}