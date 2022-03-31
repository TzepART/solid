<?php

declare(strict_types=1);

namespace App\SingleResponsibility\Problem;

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

    public function getFormattedPrices(): array
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = sprintf('%01.2f USD', $item->getPrice());
        }

        return $result;
    }
}