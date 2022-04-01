<?php

declare(strict_types=1);

namespace App\LiskovSubstitution;

use App\LiskovSubstitution\Problem\Item as ProblemItem;
use App\LiskovSubstitution\Problem\PriceCalculator as ProblemPriceCalculator;
use App\LiskovSubstitution\Problem\PriceCalculatorWithDiscount as ProblemPriceCalculatorWithDiscount;
use App\LiskovSubstitution\Solution\Item as SolutionItem;
use App\LiskovSubstitution\Solution\PriceCalculator as SolutionPriceCalculator;
use App\LiskovSubstitution\Solution\PriceCalculatorWithDiscount as SolutionPriceCalculatorWithDiscount;
use App\RunnerInterface;

class Runner implements RunnerInterface
{
    public function problemRun(): void
    {
        $items = [
            new ProblemItem(33.2),
            new ProblemItem(3.2),
            new ProblemItem(65.56),
        ];
        $discount = 0.2;

        $calculators = [
            'Simple calculator' => new ProblemPriceCalculator($items),
            'Calculator with discount' => (new ProblemPriceCalculatorWithDiscount($items))->setDiscount($discount),
        ];

        // ... some layer of business logic

        /**
         * Because we have an object instanceof of simple ProblemPriceCalculator we'll expect that method calculateItemsPrices()
         * will return price without discount. But output:
         *              Calculation without discount. Order sum 101.96
         *              Calculation without discount. Order sum 81.57 // Error here!!!
         *              Calculation with discount. Order sum 81.57
         * Because ProblemPriceCalculatorWithDiscount violates the Liskov Substitution principle. We can't use
         * an object of class ProblemPriceCalculatorWithDiscount instead object of class ProblemPriceCalculator
         */
        foreach ($calculators as $calculator) {
            if($calculator instanceof ProblemPriceCalculator){
                echo sprintf('Calculation without discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
            }

            if ($calculator instanceof ProblemPriceCalculatorWithDiscount){
                echo sprintf('Calculation with discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
            }
        }
    }

    public function solutionRun(): void
    {
        $items = [
            new SolutionItem(33.2),
            new SolutionItem(3.2),
            new SolutionItem(65.56),
        ];
        $discount = 0.2;

        $calculators = [
            'Simple calculator' => new SolutionPriceCalculator($items),
            'Calculator with discount' => (new SolutionPriceCalculatorWithDiscount($items))->setDiscount($discount),
        ];

        // ... some layer of business logic

        /**
         * Solution - add method calculateItemsPricesWithDiscount(), which will not rewrite calculateItemsPrices()
         * Then output:
         *              Calculation without discount. Order sum 101.96
         *              Calculation without discount. Order sum 101.96 // Everything is FINE!!!
         *              Calculation with discount. Order sum 81.57
         */
        foreach ($calculators as $calculator) {
            if($calculator instanceof SolutionPriceCalculator){
                echo sprintf('Calculation without discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPrices());
            }

            if ($calculator instanceof SolutionPriceCalculatorWithDiscount){
                echo sprintf('Calculation with discount. Order sum %01.2f'.PHP_EOL, $calculator->calculateItemsPricesWithDiscount());
            }
        }
    }
}