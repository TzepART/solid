<?php

declare(strict_types=1);

namespace App\OpenClosed\Problem;

class PriceCalculator
{
    /**
     * @param Item|ItemWithDiscount[] $items
     */
    public function __construct(private array $items)
    {}

    /**
     * Consider a scenario where the we want to calculate of additional prices, such as discount prices, markup prices, etc.
     * You would have to constantly edit this file and add additional if/else blocks. This would break the open-closed principle.
     */
    public function calculateItemsPrices(): float
    {
        $result = 0;
        foreach ($this->items as $item) {
            if ($item instanceof ItemWithDiscount) {
                $result += $item->getPrice() * (1 - $item->getDiscount());
            } elseif ($item instanceof Item) {
                $result += $item->getPrice();
            }
        }

        return $result;
    }
}