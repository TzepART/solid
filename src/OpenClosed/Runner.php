<?php

declare(strict_types=1);

namespace App\OpenClosed;

use App\OpenClosed\Problem\Item as ProblemItem;
use App\OpenClosed\Problem\ItemWithDiscount as ProblemItemWithDiscount;
use App\OpenClosed\Problem\PriceCalculator as ProblemPriceCalculator;
use App\OpenClosed\Solution\Item as SolutionItem;
use App\OpenClosed\Solution\ItemWithDiscount as SolutionItemWithDiscount;
use App\OpenClosed\Solution\PriceCalculator as SolutionPriceCalculator;
use App\OpenClosed\Solution\ItemWithAdditionalPrice as SolutionItemWithAdditionalPrice;
use App\RunnerInterface;

class Runner implements RunnerInterface
{
    public function problemRun(): void
    {
        $items = [
            new ProblemItem(33.2),
            new ProblemItemWithDiscount(55.2, 0.3),
            new ProblemItemWithDiscount(133.2, 0.4),
            new ProblemItem(3.2),
            new ProblemItem(65.56),
        ];

        $priceCalculator = new ProblemPriceCalculator($items);
        /**
         * We have problem with method calculateItemsPrices(). When we will add new class of Item
         * we will have to add if-section in method calculateItemsPrices. This's bad.
         */
        echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());
    }

    public function solutionRun(): void
    {
        $items = [
            new SolutionItem(33.2),
            new SolutionItemWithDiscount(55.2, 0.3),
            new SolutionItemWithDiscount(133.2, 0.4),
            new SolutionItem(3.2),
            new SolutionItem(65.56),
            new SolutionItemWithAdditionalPrice(67.11, 10.0),
            new SolutionItemWithAdditionalPrice(563.12, 20.0),
        ];

        /**
         * Solution - add ResultPriceInterface and use in method calculateItemsPrices() objects which implement this interface
         */
        $priceCalculator = new SolutionPriceCalculator($items);
        echo sprintf('Order sum %01.2f'.PHP_EOL, $priceCalculator->calculateItemsPrices());
    }
}