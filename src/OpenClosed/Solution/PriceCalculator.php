<?php

declare(strict_types=1);

namespace App\OpenClosed\Solution;

class PriceCalculator
{
    /**
     * @param ResultPriceInterface[] $items
     */
    public function __construct(private array $items)
    {}

    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            $result += $item->getResultPrice();
        }

        return $result;
    }
}