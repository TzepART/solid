<?php

declare(strict_types=1);

namespace App\SingleResponsibility\Solution;

use App\SingleResponsibility\Item;

class PriceFormatter
{
    /**
     * @param Item[] $items
     */
    public function __construct(private array $items)
    {}

    public function getFormattedPrices(): array
    {
        return $this->priceFormattingByString('USD');
    }

    public function getFormattedPricesWithSymbol(): array
    {
        return $this->priceFormattingByString('$');
    }

    private function priceFormattingByString(string $string): array
    {
        $result = [];
        foreach ($this->items as $item) {
            $result[] = sprintf('%01.2f %s', $item->getPrice(), $string);
        }

        return $result;
    }
}