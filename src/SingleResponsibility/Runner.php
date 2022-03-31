<?php

declare(strict_types=1);

namespace App\SingleResponsibility;

use App\RunnerInterface;
use App\SingleResponsibility\Problem\PriceCalculator as BadPriceCalculator;
use App\SingleResponsibility\Solution\PriceCalculator as GoodPriceCalculator;
use App\SingleResponsibility\Solution\PriceFormatter;

class Runner implements RunnerInterface
{
    public function problemRun(): void
    {
        $items = [
            new Item(33.2),
            new Item(55.2),
            new Item(133.2),
            new Item(3.2),
            new Item(65.56),
        ];

        $priceCalculator = new BadPriceCalculator($items);
        echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());

        foreach ($priceCalculator->getFormattedPrices() as $i => $formattedPrice) {
            echo sprintf('Item #%d - %s'.PHP_EOL, $i, $formattedPrice);
        }
    }

    /**
     * But if we want to have an availability in currency output use not only "USD" but also "$"
     */
    public function solutionRun(): void
    {
        $items = [
            new Item(33.2),
            new Item(55.2),
            new Item(133.2),
            new Item(3.2),
            new Item(65.56),
        ];

        $priceCalculator = new GoodPriceCalculator($items);
        echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());

        $priceFormatter = new PriceFormatter($items);
        foreach ($priceFormatter->getFormattedPrices() as $i => $formattedPrice) {
            echo sprintf('Item #%d - %s'.PHP_EOL, $i, $formattedPrice);
        }

        foreach ($priceFormatter->getFormattedPricesWithSymbol() as $i => $formattedPrice) {
            echo sprintf('Item #%d - %s'.PHP_EOL, $i, $formattedPrice);
        }
    }


}